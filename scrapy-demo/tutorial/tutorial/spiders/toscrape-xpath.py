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

from scrapy.spiders import SitemapSpider

class MySpider(SitemapSpider):
    sitemap_urls = ['http://www.example.com/robots.txt']
    sitemap_rules = [
        ('/shop/', 'parse_shop'),
    ]

    other_urls = ['http://www.example.com/about']

    def start_requests(self):
        requests = list(super(MySpider, self).start_requests())
        requests += [scrapy.Request(x, self.parse_other) for x in self.other_urls]
        return requests

    def parse_shop(self, response):
        pass # ... scrape shop here ...

    def parse_other(self, response):
        pass # ... scrape other here ...