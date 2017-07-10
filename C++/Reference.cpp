#include <iostream>

using namespace std;

double vals[] = {10.1, 21.50, 12.21, 21.12, 12.01};

double& setValues (int i)
{
    return vals[i];
}

int main()
{
    cout << "Hello wsx" << endl;
}