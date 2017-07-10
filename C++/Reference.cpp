#include <iostream>

using namespace std;

double vals[] = {10.1, 21.50, 12.21, 21.12, 12.01};

double& setValues (int i)
{
    return vals[i];
}

int main()
{
    cout << "改变前的值 : " << endl;
    for (int i = 0; i < 5; i++)
    {
        cout << "Vals[" << i <<"] : ";
        cout << vals[i] << endl;
    }

    setValues(2) = 120.1;
    setValues(4) = 215.01;

    cout << "改变后的值 : " << endl;
    for (int i = 0; i < 5; i++)
    {
        cout << "Vals[" << i <<"] : ";
        cout << vals[i] << endl;
    }

    cout << "Hello wsx" << endl;

    return 0;
}