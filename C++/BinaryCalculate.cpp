#include <iostream>
using namespace std;

#include <iomanip>
using std::setw;

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

void printArray()
{
    int n[10];
    for (int i = 0; i < 10; i++)
    {
        n[i] = i + 100;
    }
    cout << "Element" << setw(13) << "Value" << endl;

    for (int j = 0; j < 10; j++)
    {
        cout << setw(7) << j << setw(13) << n[j] << endl;
    }
}

void MoreDimensionArray()
{
    int a[3][4] = {
        {0, 1, 2, 3},
        {4, 5, 6, 7},
        {8, 9, 10, 11}
    };

    for (int i = 0; i < 3; i++)
    {
        for (int j = 0; j < 4; j++)
        {
            cout << "a[" << i << "][" << j << "] = ";
            cout << a[i][j] << endl;
        }
    }
}

int main()
{
    // BinaryCalculate();
    int a = 100;
    int b = 200;
    cout << "交换前的值 a = " << a << " , b = " << b <<endl;
    swap(a, b);
    cout << "交换后的值 a = " << a << " , b = " << b <<endl;

    printArray();

    MoreDimensionArray();

    cout << "Hello wsx" << endl;
    return 0;
}