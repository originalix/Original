#!/usr/bin/env python
# -*- coding: utf-8 -*-
__author__ = 'Lix'

import unittest
from selenium import webdriver
from selenium.webdriver.common.keys import Keys


class BaiduSearch(unittest.TestCase):
    def setUp(self):
        self.driver = webdriver.Chrome()
    
    def test_searh_in_baidu(self):
        driver = self.driver
        driver.get("https://wwww.baidu.com")
        self.assertIn(u'百度', driver.title)
        elem = driver.find_element_by_name('wd')
        elem.send_keys('wsxxxxxxxx')
        elem.send_keys(Keys.RETURN)
        assert "No Result in found." not in driver.page_source

    def tearDown(self):
        self.driver.close()

if __name__ == '__main__':
    unittest.main()
