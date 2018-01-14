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

class TBMM:
    def getPage(self):
        url = 'https://mm.taobao.com/search_tstar_model.htm'
        driver = webdriver.Chrome()
        driver.get(url)
        time.sleep(10)
        with open('tbmm.html', 'w', 'utf-8') as f:
            f.write(driver.page_source)
        driver.quit()

tbmm = TBMM()
tbmm.getPage()
