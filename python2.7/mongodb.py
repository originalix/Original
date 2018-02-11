#!/usr/bin/env python
# -*- coding=utf-8 -*-

import pymongo
"""Python 操作Mongodb 示例
"""

conn = pymongo.MongoClient()
db = conn.test
collection = db.runoob

print(collection)

def show(collection):
    # 查找
    for item in collection.find():
        print (item)

dic = {
    'name': 'wsxxxxxx',
    'age': 26,
    'address': '北苑',
    'blog': 'star1201',
}

collection.insert(dic)
show(collection)
