#!/bin/bash

# Shell 函数写法

# read -p "enter params :" commitString

readCommitMessage() {
    read -p "enter commit message: " commitString
    echo "$commitString"
}

demoFunc() {
    echo "获取到的commit message: $1" 
    if [ "$1" = "" ]
    then
        echo "commit message 为空， 请重新输入"
        demoFunc $(readCommitMessage)
    else
        echo "执行git提交过程.............."
    fi
}

echo "-----函数执行-----"
demoFunc $(readCommitMessage)
# readCommitMessage
#echo "获取到的commit message 是 $(readCommitMessage)" 
echo "-----函数结束-----"

