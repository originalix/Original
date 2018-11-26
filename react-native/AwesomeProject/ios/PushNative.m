//
//  PushNative.m
//  AwesomeProject
//
//  Created by Lix on 2018/3/14.
//  Copyright © 2018年 Facebook. All rights reserved.
//

#import "PushNative.h"
#import "AppDelegate.h"
#import "TestViewController.h"

@implementation PushNative

RCT_EXPORT_MODULE()

RCT_EXPORT_METHOD(RNOpenNativeVC:(NSString *)msg)
{
    NSLog(@"RN跳转原生界面传值数据为:%@", msg);
    dispatch_async(dispatch_get_main_queue(), ^{
      TestViewController *vc = [[TestViewController alloc] init];
      AppDelegate *app = (AppDelegate *)[[UIApplication sharedApplication] delegate];
      [app.rootNav pushViewController:vc animated:true];
    });
}

// 给Javascript发送事件

- (NSArray<NSString *> *)supportedEvents {
  return @[@"PushNative"];
}

@end
