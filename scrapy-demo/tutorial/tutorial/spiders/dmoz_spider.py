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
        for href in response.css(".cat-item > a::attr('href')"):
            url = response.urljoin(href.extract())
            print url./
            # yield scrapy.Request(url, callback=self.parse_dir_contents)

    def parse_dir_contents(self, response):
        for sel in response.xpath('//ul/li'):
            item = DmozItem()
            item['title'] = sel.xpath('a/text()').extract()
            item['link'] = sel.xpath('a/@href').extract()
            item['desc'] = sel.xpath('text()').extract()
            yield item

    # def parse(self, response):
    #     index = 0
        # for sel in response.xpath('//div[@class="site-item "]'):
    #         item = DmozItem()
    #         item['title'] = sel.xpath('//div[@class="site-title"]/text()').extract()[index]
    #         item['link'] = sel.xpath('//div[@class="title-and-desc"]/a/@href').extract()[index]
    #         item['desc'] = sel.xpath('//div[@class="site-descr "]/text()').extract()[index]
    #         yield item
    #         index += 1
    