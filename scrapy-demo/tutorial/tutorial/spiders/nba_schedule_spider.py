#!/usr/bin/env python
#-*- coding: utf-8 -*-
import scrapy

class NBAScheduleSpider(scrapy.Spider):
    name = "nba-schedule"
    start_urls = [
        "https://nba.hupu.com/schedule",
    ]

    def parse(self, response):
        # 暂时不需要title
        # titleContent = response.xpath('//tr[@class="title"]//td/text()').extract()
        # title = ""
        # for string in titleContent:
        #     # print t.encode('utf-8')
        #     title = title + string.encode('utf-8')
        # print title

        # data = response.xpath('//tr[contains(@class, "left")]')

        # 获取当前页面比赛日期
        dateOrigin = response.xpath('//tr[contains(@class, "linglei")]')
        
        for row in dateOrigin:
            date = row.xpath('./td/text()').extract_first()
            print date

            # for text in date:
            #     print text

            # x = detail.xpath('./td[@class="left"]/text()').extract()
            # for text in x:
            #     print text
            # # y = detail.xpath('./td[2]/text()').extract()
            # # for text in y:
            # #     print text            
            # a = detail.xpath('./td/a/text()').extract()
            # # print a
            # for t in a:
            #     print t.encode('utf-8')
