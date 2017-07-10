#include <iostream>

using namespace std;

class Box
{
    public:
        double length;
        double breadth;
        double height;

        double getVolume(void);
        void setLength(double len);
        void setBreadth(double bre);
        void setHeight(double hei);
};

double Box::getVolume()
{
    return length * breadth * height;
}

void Box::setLength(double len)
{
    length = len;
}

void Box::setBreadth(double bre)
{
    breadth = bre;
}

void Box::setHeight(double hei)
{
    height = hei;
}

int main()
{
    Box Box1;
    double volume = 0.0;

    Box1.setLength(5.0);
    Box1.setHeight(4.0);
    Box1.setBreadth(3.0);

    volume = Box1.getVolume();
    cout << "Box1体积: " << volume << endl;
}