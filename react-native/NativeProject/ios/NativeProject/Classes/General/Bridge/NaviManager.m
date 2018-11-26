//
//  NaviManager.m
//  NativeProject
//
//  Created by Lix on 2018/3/15.
//  Copyright © 2018年 Originalee. All rights reserved.
//

#import "NaviManager.h"
#import "PicListController.h"
#import "AppDelegate.h"

@implementation NaviManager

RCT_EXPORT_MODULE()

RCT_EXPORT_METHOD(go2PicListController)
{
    dispatch_async(dispatch_get_main_queue(), ^{
        UINavigationController *navi = (UINavigationController*)[[[UIApplication sharedApplication] keyWindow] rootViewController];
        PicListController *picVC = [[PicListController alloc] init];
        [navi pushViewController:picVC animated:true];
    });
}

@end
