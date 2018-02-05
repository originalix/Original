#!/usr/bin/env python
#-*- coding: utf-8 -*-
import scrapy

class NBAScheduleSpider(scrapy.Spider):
    name = "nba-schedule"
    start_urls = [
        "https://nba.hupu.com/schedule",
    ]

    def parse(self, response):
        title = response.xpath('//td[@class="left"]/text()').extract_first()
        print title