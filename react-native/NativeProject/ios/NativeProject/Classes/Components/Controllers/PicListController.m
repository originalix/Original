//
//  PicListController.m
//  NativeProject
//
//  Created by Lix on 2018/3/15.
//  Copyright © 2018年 Originalee. All rights reserved.
//

#import "PicListController.h"

@interface PicListController () <UITableViewDelegate, UITableViewDataSource>

@property (nonatomic, strong) UITableView *tableView;
@property (nonatomic, strong) NSMutableArray *dataSource;
@property (nonatomic, strong) NSMutableArray *touchPoints;

@end

@implementation PicListController

- (void)viewDidLoad {
    [super viewDidLoad];
    self.touchPoints = [NSMutableArray array];
    self.dataSource = [NSMutableArray array];
    for (int i = 0; i < 30; i++) {
        [self.dataSource addObject:[NSString stringWithFormat:@"第%d行", i]];
    }
    [self setupViews];
    [self setLongPressGesture];
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
}

- (void)setupViews {
    CGFloat screenWidth = [[UIScreen mainScreen] bounds].size.width;
    CGFloat screenHeight = [[UIScreen mainScreen] bounds].size.height;
    _tableView = [[UITableView alloc] initWithFrame:CGRectMake(0, 0, screenWidth, screenHeight) style:UITableViewStylePlain];
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
    cell.textLabel.text = self.dataSource[indexPath.row];
    
    return cell;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section {
    return self.dataSource.count;
}

#pragma mark - 长按tableView移动
- (UIView *)customSnapshotFromView:(UIView *)inputView {
    // 用Cell的图层生成一个Image，方便一会儿显示
    UIGraphicsBeginImageContextWithOptions(inputView.bounds.size, false, 0);
    [inputView.layer renderInContext:UIGraphicsGetCurrentContext()];
    UIImage *image = UIGraphicsGetImageFromCurrentImageContext();
    UIGraphicsEndImageContext();
    // 自定义这个快照的显示
    UIView *snapshot = [[UIImageView alloc] initWithImage:image];
    snapshot.layer.masksToBounds = false;
    snapshot.layer.cornerRadius = 0.0;
    snapshot.layer.shadowOffset = CGSizeMake(-5.0, 0.0);
    snapshot.layer.shadowRadius = 5.0;
    snapshot.layer.shadowOpacity = 0.4;
    return snapshot;
}

- (void)setLongPressGesture {
    UILongPressGestureRecognizer *gesture = [[UILongPressGestureRecognizer alloc] initWithTarget:self action:@selector(longPressGestureRecognized:)];
    [self.tableView addGestureRecognizer:gesture];
}

- (void)longPressGestureRecognized:(id)sender {
    UILongPressGestureRecognizer *longPress = (UILongPressGestureRecognizer*)sender;
    UIGestureRecognizerState state = longPress.state;
    CGPoint location = [longPress locationInView:self.tableView];
    NSIndexPath *indexPath = [self.tableView indexPathForRowAtPoint:location];
    static UIView *snapshot = nil;
    static NSIndexPath *sourceIndexPath = nil;
    
    switch (state) {
        case UIGestureRecognizerStateBegan:
            if (indexPath) {
                
                sourceIndexPath = indexPath;
                UITableViewCell *cell = [self.tableView cellForRowAtIndexPath:indexPath];
                snapshot = [self customSnapshotFromView:cell];
                __block CGPoint center = cell.center;
                snapshot.center = center;
                snapshot.alpha = 0.0;
                [self.tableView addSubview:snapshot];
                
                [UIView animateWithDuration:0.25 animations:^{
                    center.y = location.y;
                    snapshot.center = center;
                    snapshot.transform = CGAffineTransformMakeScale(1.05, 1.05);
                    snapshot.alpha = 0.98;
                    cell.alpha = 0.0;
                    
                } completion:^(BOOL finished) {
                    cell.hidden = true;
                }];
                
            }
            break;
        
        case UIGestureRecognizerStateChanged:
            [self.touchPoints addObject:[NSValue valueWithCGPoint:location]];
            if (self.touchPoints.count > 2) {
                [self.touchPoints removeObjectAtIndex:0];
            }
            CGPoint center =snapshot.center;
            center.y = location.y;
            CGPoint Ppoint = [[self.touchPoints firstObject] CGPointValue];
            CGPoint Npoint = [[self.touchPoints lastObject] CGPointValue];
            CGFloat moveX = Npoint.x - Ppoint.x;
            center.x += moveX;
            snapshot.center = center;
            NSLog(@"%@---%f----%@", self.touchPoints, moveX, NSStringFromCGPoint(center));
            NSLog(@"%@", NSStringFromCGRect(snapshot.frame));
            
            if (indexPath && ![indexPath isEqual:sourceIndexPath]) {
                [self.dataSource exchangeObjectAtIndex:indexPath.row withObjectAtIndex:sourceIndexPath.row];
                [self.tableView moveRowAtIndexPath:sourceIndexPath toIndexPath:indexPath];
                sourceIndexPath = indexPath;
            }
            break;
        
        default:
            [self.touchPoints removeAllObjects];
            UITableViewCell *cell = [self.tableView cellForRowAtIndexPath:sourceIndexPath];
            cell.hidden = false;
            cell.alpha = 0.0;
            
            [UIView animateWithDuration:0.25 animations:^{
                snapshot.center = cell.center;
                snapshot.transform = CGAffineTransformIdentity;
                snapshot.alpha = 0.0;
                cell.alpha = 1.0;
            } completion:^(BOOL finished) {
                sourceIndexPath = nil;
                [snapshot removeFromSuperview];
                snapshot = nil;
            }];
            
            break;
    }
    
}

@end
