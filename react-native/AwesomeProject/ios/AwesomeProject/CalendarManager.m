//
//  CalendarManager.m
//  AwesomeProject
//
//  Created by Lix on 2018/3/12.
//  Copyright © 2018年 Facebook. All rights reserved.
//

#import "CalendarManager.h"

@implementation CalendarManager

RCT_EXPORT_MODULE();

//RCT_EXPORT_METHOD(addEvent:(NSString *)name location:(NSString *)location)
//{
//  RCTLogInfo(@"Pretending to create an event %@ at %@", name, location);
//}

//RCT_EXPORT_METHOD(addEvent:(NSString *)name location:(NSString *)location date:(NSString *)date)
//{
////  NSDate *date = [RCTConvert NSDate:ISO8601DateString];
//  RCTLogInfo(@"%@", date);
//}

RCT_EXPORT_METHOD(addEvent:(NSString *)name details:(NSDictionary *)details)
{
  NSString *location = [RCTConvert NSString:details[@"location"]];
  NSDate *date = [RCTConvert NSDate:details[@"time"]];
  RCTLogInfo(@"location: %@, time: %@", location, date);
}

@end
