readCommitMessage() {
    read -p "Enter commit message: " commitString
    echo "$commitString"
}
 
pushFunc() {
    if [ "$1" = "" ]
    then
        echo "commit message为空，请重新输入"
        pushFunc $(readCommitMessage)
    else
        git add .
        git commit -m "[$*]"
        git push -u origin
        git push -u os
    fi
}

git diff
echo "请查看本次提交差异"
echo "确认提交请输入commit信息"
echo "如需要取消本次提交，请按ctrl+c"

pushFunc $(readCommitMessage)
