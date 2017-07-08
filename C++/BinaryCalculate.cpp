#include <iostream>
using namespace std;

void BinaryCalculate(void)
{
    unsigned int a = 30;
    unsigned int b = 11;
    int c = 0;

    c = a & b;
    cout << "Line 1 - C 的值是 " << c << endl;

    c = a | b;
    cout << "Line 2 - C 的值是 " << c << endl;

    c = a ^ b;
    cout << "Line 3 - C 的值是 " << c << endl;

    c = ~a;
    cout << "Line 4 - C 的值是 " << c << endl;

    c = ~b;
    cout << "Line 5 - C 的值是 " << c << endl;

    c = a << 2;
    cout << "Line 6 - C 的值是 " << c << endl;

    c = b >> 2;
    cout << "Line 7 - C 的值是 " << c << endl;
}

// void swap(int *x, int *y)
// {
//     int temp;

//     temp = *x;
//     *x = *y;
//     *y = temp;

//     return;
// }

void swap(int &x, int &y)
{
    int temp;

    temp = x;
    x = y;
    y = temp;

    return;
}

int main()
{
    // BinaryCalculate();
    int a = 100;
    int b = 200;
    cout << "交换前的值 a = " << a << " , b = " << b <<endl;
    swap(a, b);
    cout << "交换后的值 a = " << a << " , b = " << b <<endl;

    cout << "Hello wsx" << endl;
    return 0;
}