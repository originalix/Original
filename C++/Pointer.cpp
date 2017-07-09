#include <iostream>

using namespace std;

void testPointerValue()
{
    int var = 20;
    int *ip;

    ip = &var;

    cout << "Value of var variable: ";
    cout << var << endl;

    //输出在指针变量中存储的地址
    cout << "Address stored in ip variable: ";
    cout << ip << endl;

    cout << "Value of *ip variable: ";
    cout << *ip << endl;
}

void NullPointer()
{
    int *ptr = NULL;

    cout << "ptr 的值是 " << ptr << endl;

    if (ptr)
        cout << "ptr 非空" << endl;
    if (!ptr)
        cout << "ptr 为空" << endl;
}

const int MAX = 3;

void ArrayPointer()
{
    int var[MAX] = {10, 21, 1201};
    int *ptr;

    ptr = var;
    for (int i = 0; i < MAX; i++)
    {
        cout << "Address of var[" << i << "] = ";
        cout << ptr << endl;

        cout << "Value of var [" << i << "] = ";
        cout << *ptr << endl;

        ptr++;
    }
}

void DestArrayPointer()
{
    int var[MAX] = {10, 21, 1201};
    int *ptr;

    ptr = &var[MAX - 1];
    for (int i = MAX; i > 0; i--)
    {
        cout << "Address of var[" << i << "] = ";
        cout << ptr << endl;

        cout << "Value of var [" << i << "] = ";
        cout << *ptr << endl;

        ptr--;
    }
}

int main()
{

    testPointerValue();

    NullPointer();

    // ArrayPointer();

    DestArrayPointer();

    cout << "Hello wsx" << endl;
    return 0;
}