#!/bin/bash

# Shell 函数写法

demoFunc() {
    echo "第一个参数为 $1 !"
    echo "第二个参数为 $2 !"
    echo "参数总数共有 $# 个!"
    echo "作为一个字符串输出所有的参数 $* !"
}

echo "-----函数执行-----"
demoFunc 1 2 3 4 5 2150 1201
echo "-----函数结束-----"
