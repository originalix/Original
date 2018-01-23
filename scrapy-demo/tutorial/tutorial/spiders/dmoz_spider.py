#!/usr/bin/env python
# -*- coding: utf-8 -*-
__author__ = "Lix"

import scrapy
from tutorial.items import DmozItem

class DmozSpider(scrapy.Spider):
    name = "dmoz"
    allowed_domains = ['dmoztools.net']
    start_urls = [
        "http://dmoztools.net/Computers/Programming/Languages/Python/Books/",
        # "http://dmoztools.net/Computers/Programming/Languages/Python/Resources/"
    ]

    def parse(self, response):
        index = 0
        for sel in response.xpath('//div[@class="site-item "]'):
            # print sel
            item = DmozItem()
            item['title'] = sel.xpath('/div').extract()
            # item['link'] = sel.xpath('a/@href').extract()
            # item['desc'] = sel.xpath('text()').extract()
            # yield item
    