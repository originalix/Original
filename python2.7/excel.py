#!/usr/bin/env python
# -*- coding=utf-8 -*-

import xlrd
import xlwt

def read_exc():
    workbook = xlrd.open_workbook(r'/Users/Lix/Desktop/test.xlsx')
    print workbook.sheet_names()


def main():
    read_exc()

if __name__ == '__main__':
    main()