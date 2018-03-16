//
//  ViewController.m
//  NativeProject
//
//  Created by Lix on 2018/3/15.
//  Copyright © 2018年 Originalee. All rights reserved.
//

#import "ViewController.h"
#import <React/RCTRootView.h>
#import <React/RCTBundleURLProvider.h>
#import "PicListController.h"
#import "PicScrollController.h"

@interface ViewController ()

@end

@implementation ViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view, typically from a nib.
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (IBAction)goToRNView:(id)sender {
    NSURL *jsCodeLocation;
    jsCodeLocation = [[RCTBundleURLProvider sharedSettings] jsBundleURLForBundleRoot:@"index" fallbackResource:nil];
    RCTRootView *rootView = [[RCTRootView alloc] initWithBundleURL:jsCodeLocation
                                                        moduleName:@"NativeProject"
                                                 initialProperties:@{
                                                                            @"name" : @"lixxxxx"
                                                                            }
                                                     launchOptions:nil];
    UIViewController *vc = [[UIViewController alloc] init];
    vc.view = rootView;
    [self.navigationController pushViewController:vc animated:true];
}

- (IBAction)goToNextView:(id)sender {
//    NSURL *jsCodeLocation;
//    jsCodeLocation = [[RCTBundleURLProvider sharedSettings] jsBundleURLForBundleRoot:@"src/component/RootView" fallbackResource:nil];
//    RCTRootView *rootView = [[RCTRootView alloc] initWithBundleURL:jsCodeLocation
//                                                        moduleName:@"NativeProject"
//                                                 initialProperties:@{
//                                                                     @"name" : @"lixxxxx"
//                                                                     }
//                                                     launchOptions:nil];
//    UIViewController *vc = [[UIViewController alloc] init];
//    vc.view = rootView;
//    [self.navigationController pushViewController:vc animated:true];
    
    PicListController *vc = [[PicListController alloc] init];
    [self.navigationController pushViewController:vc animated:true];
}

- (IBAction)go2PicScroll:(id)sender {
    PicScrollController *vc = [[PicScrollController alloc] init];
    [self.navigationController pushViewController:vc animated:true];
}

@end
