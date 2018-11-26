#!/usr/bin/env python
# -*- coding: utf-8 -*-
import scrapy
from tutorial.items import ScheduleItem

class NBAScheduleSpider(scrapy.Spider):
    name = "nba-schedule"
    start_urls = [
        "https://nba.hupu.com/schedule",
    ]

    def parse(self, response):

        players_table = response.xpath('//table[@class="players_table"]/tbody/tr[contains(@class, "left")]')

        current_time = ""
        for data in players_table:

            if len(data.xpath('./td[@colspan="3"]')) > 0:
                current_time = data.xpath('./td[@colspan="3"]/text()').extract_first()

            else:
                item = ScheduleItem()
                item['date'] = current_time
                item['time'] = data.xpath('./td[@class="left"]/text()').extract_first()
                item['guest'] = data.xpath('./td/a[1]/text()').extract_first()
                item['home'] = data.xpath('./td/a[2]/text()').extract_first()
                
                yield item
        next_page_url = response.xpath('//div[@class="a"]/b/a[@class="t3"]/@href').extract_first()
        if next_page_url is not None:
            yield scrapy.Request(response.urljoin(next_page_url))
