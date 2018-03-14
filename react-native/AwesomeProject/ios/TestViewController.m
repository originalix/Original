//
//  TestViewController.m
//  AwesomeProject
//
//  Created by Lix on 2018/3/14.
//  Copyright © 2018年 Facebook. All rights reserved.
//

#import "TestViewController.h"
#import "RNViewController.h"
#import <React/RCTBundleURLProvider.h>
#import <React/RCTRootView.h>

@interface TestViewController ()

@end

@implementation TestViewController

- (void)viewWillAppear:(BOOL)animated {
  [super viewWillAppear:animated];
  [self.navigationController setNavigationBarHidden:false animated:animated];
}

- (void)viewDidLoad {
    [super viewDidLoad];
    self.navigationItem.title = @"原生测试页面";
    self.view.backgroundColor = [UIColor redColor];
    UIButton *button = [UIButton buttonWithType:UIButtonTypeCustom];
    [button addTarget:self action:@selector(buttonClick:) forControlEvents:UIControlEventTouchUpInside];
    button.backgroundColor = [UIColor yellowColor];
    button.frame = CGRectMake(100, 100, 100, 50);
    [self.view addSubview:button];
}

- (void)viewWillDisappear:(BOOL)animated {
  [super viewWillDisappear:animated];
  [self.navigationController setNavigationBarHidden:true animated:animated];
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
}

- (void)buttonClick:(UIButton *)sender {
//    RNViewController *vc = [[RNViewController alloc] init];
//    [self.navigationController pushViewController:vc animated:true];
  
  NSURL *jsCodeLocation;
  
  jsCodeLocation = [[RCTBundleURLProvider sharedSettings] jsBundleURLForBundleRoot:@"index" fallbackResource:nil];
  
  RCTRootView *rootView = [[RCTRootView alloc] initWithBundleURL:jsCodeLocation
                                                      moduleName:@"AwesomeProject"
                                               initialProperties:nil
                                                   launchOptions:nil];
  rootView.backgroundColor = [[UIColor alloc] initWithRed:1.0f green:1.0f blue:1.0f alpha:1];
  UIViewController *vc = [UIViewController new];
  vc.view = rootView;
  [self.navigationController pushViewController:vc animated:true];
}

@end
