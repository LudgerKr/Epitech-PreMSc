#include "Pair.hpp"

int main(int ac, char *av[])
{
    // Pair<int> pair(10, 10);
    Pair<int> pairint(12, 10);
    std::cout << pairint.min() << std::endl;

    Pair<float> pairfloat(12.01, 10.05);
    std::cout << pairfloat.min() << std::endl;

    Pair<std::string> pairstdstring("hello", "no");
    std::cout << pairstdstring.min() << std::endl;

    return (0);
}