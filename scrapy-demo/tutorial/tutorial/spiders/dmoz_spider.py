#!/usr/bin/env python
# -*- coding: utf-8 -*-
__author__ = "Lix"

import scrapy
from tutorial.items import DmozItem

class DmozSpider(scrapy.Spider):
    name = "dmoz"
    allowed_domains = ['dmoztools.net']
    start_urls = [
        "http://dmoztools.net/Computers/Programming/Languages/Python/",
        # "http://dmoztools.net/Computers/Programming/Languages/Python/Books/",
        # "http://dmoztools.net/Computers/Programming/Languages/Python/Resources/"
    ]

    def parse(self, response):
        for item in response.xpath('//div[@class="cat-item"]'):
            print item

    # def parse(self, response):
    #     index = 0
    #     for sel in response.xpath('//div[@class="site-item "]'):
    #         item = DmozItem()
    #         item['title'] = sel.xpath('//div[@class="site-title"]/text()').extract()[index]
    #         item['link'] = sel.xpath('//div[@class="title-and-desc"]/a/@href').extract()[index]
    #         item['desc'] = sel.xpath('//div[@class="site-descr "]/text()').extract()[index]
    #         yield item
    #         index += 1
    