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

#  插入
dic = {
    'name': 'wsxxxxxx',
    'age': 26,
    'address': '北苑',
    'blog': 'star1201',
}

# collection.insert(dic)
# show(collection)

# 插入多条记录
many = []
import copy
for index in range(1, 8):
    tempdic = copy.deepcopy(dic)
    tempdic['age'] = index * 2
    many.append(tempdic)

collection.insert_many(many)
# show(collection)

# 删除记录
collection.remove({ 'name' : 'wsxxxxxx' })
show(collection)

