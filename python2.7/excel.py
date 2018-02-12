#!/usr/bin/env python
# -*- coding=utf-8 -*-

import xlrd
import xlwt

def read_exc():
    workbook = xlrd.open_workbook(r'/Users/Lix/Desktop/test.xlsx')
    print workbook.sheet_names()

    main_sheet = workbook.sheet_by_index(0)
    # sheet的名称，行数，列数
    print main_sheet.name, main_sheet.nrows,main_sheet.ncols

    # 获取整行和整列的值（数组）
    rows = main_sheet.row_values(2) # 获取第三行内容
    cols = main_sheet.col_values(2) # 获取第三列内容
    print rows
    print cols

def main():
    read_exc()

if __name__ == '__main__':
    main()