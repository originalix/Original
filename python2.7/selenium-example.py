#!/usr/bin/env python
# -*- coding: utf-8 -*-

__author__ = 'Lix'

from selenium import webdriver
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.common.by import By
import time

def selenium_example():
    site_url = 'https://elcjstyle.taobao.com/search.htm?spm=a1z10.1-c-s.0.0.68616fccLXsimv&search=y'

    driver = webdriver.Chrome()
    driver.get(site_url)
    time.sleep(3)
    content = driver.page_source.encode('utf-8')
    print driver.title
    print content

def main():
    selenium_example()

if __name__ == "__main__":
    main()
