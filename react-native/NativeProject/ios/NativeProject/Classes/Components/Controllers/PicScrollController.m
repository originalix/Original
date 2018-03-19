//
//  PicScrollController.m
//  NativeProject
//
//  Created by Lix on 2018/3/16.
//  Copyright © 2018年 Originalee. All rights reserved.
//

#import "PicScrollController.h"
#import "LixTouchImgView.h"

@interface PicScrollController () <UIGestureRecognizerDelegate>

@property (nonatomic, strong) UIScrollView *scrollView;

@end

@implementation PicScrollController

- (void)viewDidLoad {
    [super viewDidLoad];
    self.view.backgroundColor = [UIColor whiteColor];
    [self setupViews];
    NSArray *imgArr = @[@"1.PNG", @"2.PNG", @"3.PNG"];
    NSInteger index = 0;
    CGFloat screenWidth = [[UIScreen mainScreen] bounds].size.width;
    CGFloat screenHeight = [[UIScreen mainScreen] bounds].size.height;
    for (NSString *imgName in imgArr) {
        CGFloat y = index * screenHeight;
        UIImage *img = [UIImage imageNamed:imgName];
        UIImageView *imgView = [[UIImageView alloc] initWithImage:img];
        imgView.frame = CGRectMake(0, y, screenWidth, screenHeight);
        imgView.tag = index;
        imgView.userInteractionEnabled = true;
        
        // 添加上滑下滑手势
        UISwipeGestureRecognizer *upSwipeGesture = [[UISwipeGestureRecognizer alloc] initWithTarget:self action:@selector(tapAction:)];
        upSwipeGesture.direction = UISwipeGestureRecognizerDirectionUp;
        upSwipeGesture.delegate = self;
        UISwipeGestureRecognizer *downSwipeGesture = [[UISwipeGestureRecognizer alloc] initWithTarget:self action:@selector(tapAction:)];
        downSwipeGesture.direction = UISwipeGestureRecognizerDirectionDown;
        downSwipeGesture.delegate = self;
        
        [imgView addGestureRecognizer:upSwipeGesture];
        [imgView addGestureRecognizer:downSwipeGesture];
        
        self.scrollView.contentSize = CGSizeMake(screenWidth, y + screenHeight);
        [self.scrollView addSubview:imgView];
        index += 1;
    }
    
    UIGestureRecognizer *gesture = [[UIGestureRecognizer alloc] init];
    gesture.delegate = self;
    [self.scrollView addGestureRecognizer:gesture];
    
//    UITapGestureRecognizer *tapRecognizer = [[UITapGestureRecognizer alloc] initWithTarget:self action:@selector(tapAction:)];
//    [self.scrollView addGestureRecognizer:tapRecognizer];
    
}

- (void)tapAction:(UISwipeGestureRecognizer *)sender {
//    CGPoint tapPoint = [sender locationInView:self.scrollView];
//    CGPoint tapPointInView = [self.scrollView convertPoint:tapPoint toView:self.view];
//
//    NSLog(@"%@, %@", NSStringFromCGPoint(tapPoint), NSStringFromCGPoint(tapPointInView));
//    NSLog(@"点击了第%ld张图片", sender.view.tag);
//    CGPoint current = [touch locationInView:touch.view];
//    CGPoint previous = [touch previousLocationInView:touch.view];
//    CGPoint current = [sender locationInView:sender.view];
    if (sender.direction == UISwipeGestureRecognizerDirectionUp) {
        NSLog(@"向上滑动");
    }
    
    if (sender.direction == UISwipeGestureRecognizerDirectionDown) {
        NSLog(@"向下滑动");
    }
}

- (BOOL)gestureRecognizer:(UIGestureRecognizer *)gestureRecognizer shouldReceiveTouch:(UITouch *)touch {
    if ([gestureRecognizer.view isKindOfClass:[UIImageView class]]) {
        NSLog(@"imgView触摸");
        self.scrollView.scrollEnabled = NO;
        return YES;
    } else {
        NSLog(@"scrollView 触摸");
        self.scrollView.scrollEnabled = YES;
        return NO;
    }
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
}

#pragma mark - setupViews
- (void)setupViews {
    CGFloat screenWidth = [[UIScreen mainScreen] bounds].size.width;
    CGFloat screenHeight = [[UIScreen mainScreen] bounds].size.height;
    _scrollView = [[UIScrollView alloc] initWithFrame:CGRectMake(0, 64, screenWidth, screenHeight - 64)];
    _scrollView.contentSize = self.view.bounds.size;
    [self.view addSubview:self.scrollView];
}

@end
