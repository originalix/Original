//
//  PicListController.m
//  NativeProject
//
//  Created by Lix on 2018/3/15.
//  Copyright © 2018年 Originalee. All rights reserved.
//

#import "PicListController.h"

typedef enum {
    AutoScrollUp,
    AutoScrollDown
} AutoScroll;

@interface PicListController () <UITableViewDelegate, UITableViewDataSource>

@property (nonatomic, strong) UITableView *tableView;
@property (nonatomic, strong) NSMutableArray *originalArray;
@property (nonatomic, strong) UIImageView *snapshot;
@property (nonatomic, strong) NSIndexPath *fromIndexPath;
@property (nonatomic, strong) NSIndexPath *toIndexPath;
@property (nonatomic, strong) CADisplayLink *displayLink;
@property (nonatomic, assign) AutoScroll autoScroll;
@property (nonatomic, assign) NSInteger index;

@end

@implementation PicListController

- (void)viewDidLoad {
    [super viewDidLoad];

    self.dataArray = [NSMutableArray array];
    self.originalArray = [NSMutableArray array];
    for (int i = 0; i < 30; i++) {
        [self.dataArray addObject:[NSString stringWithFormat:@"第%d行", i]];
    }
    
    self.originalArray = [self.dataArray mutableCopy];
    [self setupViews];
    [self setLongPressGesture];
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
}

- (void)setupViews {
    CGFloat screenWidth = [[UIScreen mainScreen] bounds].size.width;
    CGFloat screenHeight = [[UIScreen mainScreen] bounds].size.height;
    _tableView = [[UITableView alloc] initWithFrame:CGRectMake(0, 64, screenWidth, screenHeight - 64) style:UITableViewStylePlain];
    [_tableView registerClass:[UITableViewCell class] forCellReuseIdentifier:@"cell"];
    _tableView.delegate = self;
    _tableView.dataSource = self;
    [self.view addSubview:self.tableView];
}

#pragma UITableView Delegate
- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath {
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:@"cell" forIndexPath:indexPath];
    if (! cell) {
        cell = [[UITableViewCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:@"cell"];
    }
    cell.textLabel.text = self.dataArray[indexPath.row];
    
    return cell;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section {
    return self.dataArray.count;
}

#pragma mark - 长按tableView移动
- (UIImageView *)customSnapshotFromView:(UIView *)inputView {
    // 用Cell的图层生成一个Image，方便一会儿显示
    UIGraphicsBeginImageContextWithOptions(inputView.bounds.size, false, 0);
    [inputView.layer renderInContext:UIGraphicsGetCurrentContext()];
    UIImage *image = UIGraphicsGetImageFromCurrentImageContext();
    UIGraphicsEndImageContext();
    // 自定义这个快照的显示
    UIImageView *snapshot = [[UIImageView alloc] initWithImage:image];
    snapshot.layer.masksToBounds = false;
    snapshot.layer.cornerRadius = 0.0;
    snapshot.layer.shadowOffset = CGSizeMake(-0.0, 0.0);
    snapshot.layer.shadowRadius = 0.0;
    snapshot.layer.shadowOpacity = 0.4;
    return snapshot;
}

- (void)setLongPressGesture {
    if (_scrollSpeed == 0) {
        _scrollSpeed = 3;
    }
    UILongPressGestureRecognizer *gesture = [[UILongPressGestureRecognizer alloc] initWithTarget:self action:@selector(moveRow:)];
    [self.tableView addGestureRecognizer:gesture];
}

- (void)moveRow:(UILongPressGestureRecognizer *)sender {
    //获取点击的位置
    CGPoint point = [sender locationInView:self.tableView];
    if (sender.state == UIGestureRecognizerStateBegan) {
        //根据手势点击的位置，获取被点击cell所在的indexPath
        self.fromIndexPath = [self.tableView indexPathForRowAtPoint:point];
        
        if (!_fromIndexPath) return;
        //根据indexPath获取cell
        UITableViewCell *cell = [self.tableView cellForRowAtIndexPath:_fromIndexPath];
        
        //创建一个imageView，imageView的image由cell渲染得来
        self.snapshot = [self createCellImageView:cell];
        
        //更改imageView的中心点为手指点击位置
        __block CGPoint center = cell.center;
        _snapshot.center = center;
        _snapshot.alpha = 0.0;
        [UIView animateWithDuration:0.25 animations:^{
            center.y = point.y;
            _snapshot.center = center;
            _snapshot.transform = CGAffineTransformMakeScale(1.05, 1.05);
            _snapshot.alpha = 0.98;
            cell.alpha = 0.0;
        } completion:^(BOOL finished) {
            cell.hidden = YES;
        }];
        
    } else if (sender.state == UIGestureRecognizerStateChanged){
        //根据手势的位置，获取手指移动到的cell的indexPath
        _toIndexPath = [self.tableView indexPathForRowAtPoint:point];
        
        //更改imageView的中心点为手指点击位置
        CGPoint center = self.snapshot.center;
        center.y = point.y;
        self.snapshot.center = center;
        
        //判断cell是否被拖拽到了tableView的边缘，如果是，则自动滚动tableView
        if ([self isScrollToEdge]) {
            [self startTimerToScrollTableView];
        } else {
            [_displayLink invalidate];
        }
        
        /*
         若当前手指所在indexPath不是要移动cell的indexPath，
         且是插入模式，则执行cell的插入操作
         每次移动手指都要执行该判断，实时插入
         */
        if (_toIndexPath && ![_toIndexPath isEqual:_fromIndexPath] && !self.isExchange)
            [self insertCell:_toIndexPath];
        
    } else {
        /*
         如果是交换模式，则执行交换操作
         交换操作等手势结束时执行，不用每次移动都执行
         */
        if (self.isExchange) [self exchangeCell:point];
        [_displayLink invalidate];
        //将隐藏的cell显示出来，并将imageView移除掉
        UITableViewCell *cell = [self.tableView cellForRowAtIndexPath:_fromIndexPath];
        cell.hidden = NO;
        cell.alpha = 0;
        [UIView animateWithDuration:0.25 animations:^{
            
            cell.alpha = 1;
            _snapshot.alpha = 0;
            _snapshot.transform = CGAffineTransformIdentity;
            _snapshot.center = cell.center;
        } completion:^(BOOL finished) {
            [self.snapshot removeFromSuperview];
            self.snapshot = nil;
        }];
    }
}



- (BOOL)isScrollToEdge {
    if ((CGRectGetMaxY(self.snapshot.frame) > self.tableView.contentOffset.y + self.tableView.frame.size.height - self.tableView.contentInset.bottom) && (self.tableView.contentOffset.y < self.tableView.contentSize.height - self.tableView.frame.size.height + self.tableView.contentInset.bottom)) {
        self.autoScroll = AutoScrollDown;
        return YES;
    }
    
    if ((self.snapshot.frame.origin.y < self.tableView.contentOffset.y + self.tableView.contentInset.top) && (self.tableView.contentOffset.y > -self.tableView.contentInset.top)) {
        self.autoScroll = AutoScrollUp;
        return YES;
    }
    
    return NO;
}

- (void)startTimerToScrollTableView {
    [_displayLink invalidate];
    _displayLink = [CADisplayLink displayLinkWithTarget:self selector:@selector(scrollTableView)];
    [_displayLink addToRunLoop:[NSRunLoop currentRunLoop] forMode:NSRunLoopCommonModes];
}

- (void)scrollTableView{
    //如果已经滚动到最上面或最下面，则停止定时器并返回
    if ((_autoScroll == AutoScrollUp && self.tableView.contentOffset.y <= -self.tableView.contentInset.top)
        || (_autoScroll == AutoScrollDown && self.tableView.contentOffset.y >= self.tableView.contentSize.height - self.tableView.frame.size.height + self.tableView.contentInset.bottom)) {
        [_displayLink invalidate];
        return;
    }
    
    //改变tableView的contentOffset，实现自动滚动
    CGFloat height = _autoScroll == AutoScrollUp? -_scrollSpeed : _scrollSpeed;
    [self.tableView setContentOffset:CGPointMake(0, self.tableView.contentOffset.y + height)];
    //改变cellImageView的位置为手指所在位置
    _snapshot.center = CGPointMake(_snapshot.center.x, _snapshot.center.y + height);
    
    //滚动tableView的同时也要执行插入操作
    _toIndexPath = [self.tableView indexPathForRowAtPoint:_snapshot.center];
    if (_toIndexPath && ![_toIndexPath isEqual:_fromIndexPath] && !self.isExchange)
        [self insertCell:_toIndexPath];
}

- (void)insertCell:(NSIndexPath *)toIndexPath {
    if (self.isGroup) {
        //先将cell的数据模型从之前的数组中移除，然后再插入新的数组
        NSMutableArray *fromSection = self.dataArray[_fromIndexPath.section];
        NSMutableArray *toSection = self.dataArray[toIndexPath.section];
        id obj = fromSection[_fromIndexPath.row];
        [fromSection removeObject:obj];
        [toSection insertObject:obj atIndex:toIndexPath.row];
        
        //如果某个组的所有cell都被移动到其他组，则删除这个组
        if (!fromSection.count) {
            [self.dataArray removeObject:fromSection];
        }
    } else {
        //交换两个cell的数据模型
        [self.dataArray exchangeObjectAtIndex:_fromIndexPath.row withObjectAtIndex:toIndexPath.row];
    }
//    [self.tableView reloadData];
    [self.tableView moveRowAtIndexPath:_fromIndexPath toIndexPath:_toIndexPath];
    
    UITableViewCell *cell = [self.tableView cellForRowAtIndexPath:toIndexPath];
    cell.hidden = YES;
    _fromIndexPath = toIndexPath;
}

- (void)exchangeCell:(CGPoint)point {
    NSIndexPath *toIndexPath = [self.tableView indexPathForRowAtPoint:point];
    if (!toIndexPath) return;
    //交换要移动cell与被替换cell的数据模型
    if (self.isGroup) {
        //分组情况下，交换模型的过程比较复杂
        NSMutableArray *fromSection = self.dataArray[_fromIndexPath.section];
        NSMutableArray *toSection = self.dataArray[toIndexPath.section];
        id obj = fromSection[_fromIndexPath.row];
        [fromSection replaceObjectAtIndex:_fromIndexPath.row withObject:toSection[toIndexPath.row]];
        [toSection replaceObjectAtIndex:toIndexPath.row withObject:obj];
    } else {
        [self.dataArray exchangeObjectAtIndex:_fromIndexPath.row withObjectAtIndex:toIndexPath.row];
    }
    [self.tableView moveRowAtIndexPath:_fromIndexPath toIndexPath:_toIndexPath];
//    [self.tableView reloadData];
}

- (void)resetCellLocation {
    [_dataArray removeAllObjects];
    [_dataArray addObjectsFromArray:_originalArray];
    if (_isGroup) {
        for (int i = 0; i < _dataArray.count; i++) {
            _originalArray[i] = [_dataArray[i] mutableCopy];
        }
    }
    [self.tableView reloadData];
}

- (UIImageView *)createCellImageView:(UITableViewCell *)cell {
    //打开图形上下文，并将cell的根层渲染到上下文中，生成图片
//    UIGraphicsBeginImageContext(cell.bounds.size);
    UIGraphicsBeginImageContextWithOptions(cell.bounds.size, NO, 0);
    [cell.layer renderInContext:UIGraphicsGetCurrentContext()];
    UIImage *image = UIGraphicsGetImageFromCurrentImageContext();
    UIGraphicsEndImageContext();
    UIImageView *cellImageView = [[UIImageView alloc] initWithImage:image];
    cellImageView.layer.masksToBounds = NO;
    cellImageView.layer.cornerRadius = 0.0;
    cellImageView.layer.shadowOffset = CGSizeMake(-5.0, 0.0);
    cellImageView.layer.shadowRadius = 5.0;
    cellImageView.layer.shadowOpacity = 0.4;
    [self.tableView addSubview:cellImageView];
    return cellImageView;
}

#pragma mark - get & set
- (void)setDataArray:(NSMutableArray *)dataArray {
    _dataArray = dataArray;
    _originalArray = [dataArray mutableCopy];
    if (_isGroup) {
        for (int i = 0; i < dataArray.count; i++) {
            _originalArray[i] = [dataArray[i] mutableCopy];
        }
    }
}

@end
