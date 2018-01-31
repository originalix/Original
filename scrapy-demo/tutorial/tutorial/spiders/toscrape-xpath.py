#!/usr/bin/env python
# -*- coding: utf-8 -*-
import scrapy

class ToScrapeXpathSpider(scrapy.Spider):
    name = "toscrape-xpath"
    start_urls = [
        "http://quotes.toscrape.com/",
    ]

    def parse(self, response):
        for quote in response.xpath('//div[@class="quote"]'):
            yield {
                'text' : quote.xpath('./span[@class="text"]/text()').extract_first(),
                'author' : quote.xpath('.//small[@class="author"]/text()').extract_first(),
                'tag' : quote.xpath('.//div[@class="tags"]/a[@class="tag"]/text()').extract()
            }

        next_page_url = quote.xpath('//li[@class="next"]/a/@href').extract_first()
        if next_page_url is not None:
            yield scrapy.Request(response.urljoin(next_page_url))

class MySpider(scrapy.Spider):
    name = 'myspider'

    def start_requests(self):
        return [scrapy.FormRequest("http://www.example.com/login",
                                   formdata={'user': 'john', 'pass': 'secret'},
                                   callback=self.logged_in)]

    def logged_in(self, response):
        # here you would extract links to follow and return Requests for
        # each of them, with another callback
        pass