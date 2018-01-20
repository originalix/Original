#!/bin/bash

# Shell 函数写法

# read -p "enter params :" commitString

readCommitMessage() {
    read -p "enter commit message: " commitString
    return "$commitString"
}

demoFunc() {
    if [ "$commitString" = "" ]
    then
        echo "commit message 为空， 请重新输入"
    else
        echo "执行git提交过程.............."
    fi
}

echo "-----函数执行-----"
# demoFunc $commitString
readCommitMessage
echo "获取到的commit message 是 $? !"
echo "-----函数结束-----"

