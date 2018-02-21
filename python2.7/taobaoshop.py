#!/usr/bin/env python
# -*- coding=utf-8 -*-

__author__ = 'Lix'

# from bs4 import BeautifulSoup
from lxml import etree
from selenium import webdriver
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.common.by import By
import time
import re
import requests
import os

class taobaoShop:
    def __init__(self):
        self.site_url = 'https://elcjstyle.taobao.com/search.htm?spm=a1z10.1-c-s.0.0.68616fccLXsimv&search=y'
        self.driver = webdriver.Chrome()
        self.sleep_time = 1
        self.save_img_path = '/Users/Lix/Documents/www/htdocs/origin/tbmm/'
        self.total_page = 1
        self.current_page = 1

    def getPage(self):
        self.driver.get(self.site_url)
        time.sleep(self.sleep_time)
        content = self.driver.page_source.encode('utf-8')
        print self.driver.title
        # selector = etree.HTML(content)
        # print selector
        # res = selector.xpath('//div[@id="J_ShopSearchResult"]/div/div[2]')
        # print res
        # soup = BeautifulSoup(content, 'html.parser')
        # self.getTotalPage(soup)
        ele = self.driver.find_element(By.XPATH, '//*[@id="J_ShopSearchResult"]/div/div[2]/div[2]/dl[1]/dt/a/img')
        print ele
        self.saveHtml('taobaoshop', content)
        # return soup

    def saveHtml(self, file_name, file_content):  
        #    注意windows文件命名的禁用符，比如 /  
        with open(file_name.replace('/', '_') + ".html", "wb") as f:
            #   写文件用bytes而不是str，所以要转码  
            f.write(file_content)

def main():
    tb = taobaoShop()
    tb.getPage()

if __name__ == "__main__":
    main()
