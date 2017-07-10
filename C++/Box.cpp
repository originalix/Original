#include <iostream>

using namespace std;

class Box
{
    public:
        double length;
        double breadth;
        double height;
};

int main()
{
    Box Box1;
    Box Box2;
    double volume = 0.0;

    Box1.height = 5.0;
    Box1.length = 7.0;
    Box1.breadth = 6.0;

    volume = Box1.height * Box1.length * Box1.breadth;
    cout << "Box1体积: " << volume << endl;
}