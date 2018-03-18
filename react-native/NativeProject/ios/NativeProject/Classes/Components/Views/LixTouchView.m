//
//  LixTouchView.m
//  NativeProject
//
//  Created by Lix on 2018/3/17.
//  Copyright © 2018年 Originalee. All rights reserved.
//

#import "LixTouchView.h"

@implementation LixTouchView

- (void)touchesBegan:(NSSet<UITouch *> *)touches withEvent:(UIEvent *)event {
    // 获取当前触摸点的UITouch对象
    UITouch *touch = [touches anyObject];
    // 触摸点 所在View
    NSLog(@"%@", touch.view);
    // 触摸次数
    NSLog(@"%ld", touch.tapCount);
    // 获取当前触摸位置
    CGPoint touchPosition = [touch locationInView:touch.view];
    NSLog(@"%@", NSStringFromCGPoint(touchPosition));
}

@end
