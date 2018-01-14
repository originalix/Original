#!/usr/bin/env python
# -*- coding: utf-8 -*-
__author__ = 'Lix'

from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time
import re

class TBMM:
    def __init__(self):
        self.site_url = 'https://mm.taobao.com/search_tstar_model.htm'
        self.driver = webdriver.PhantomJS()
        self.sleep_time = 3

    def getPage(self):
        self.driver.get(self.site_url)
        time.sleep(self.sleep_time)
        content = self.driver.page_source.encode('utf-8')
        self.driver.quit()
        soup = BeautifulSoup(content, 'html.parser')
        return soup
    
    def getContent(self, soup):
        items = soup.find_all(class_='item')
        for item in items:
            print item
            print u'----分割线---'
            page_code = str(item)
            name = item.find(class_='name').text
            city = item.find(class_='city').text
            pattern = re.compile(r'data-ks-lazyload="(.*?)"', re.S)
            result = re.search(pattern, page_code)
            if result:
                print 'http:' + result.group(1).strip()
                print name
                print city
            else:
                print 'not found img src'            
            print '----------------------------------'
    
    def start(self):
        soup = self.getPage()
        self.getContent(soup)

tbmm = TBMM()
tbmm.start()
