#!/usr/bin/env python
# -*- coding: utf-8 -*-
import scrapy

class ToScrapeXpathSpider(scrapy.Spider):
    name = "toscrape-xpath"
    start_urls = [
        "http://quotes.toscrape.com/",
    ]

    def parse(self, response):
        for quote in response.xpath("//div[@class='quote']"):
            print quote