#include <iostream>
#include <limits>

int main(){
    std::cout << "Typy całkowitoliczbowe:" << std::endl;
    std::cout << "-----------------------" << std::endl;
    std::cout << "short: " << sizeof(short) << " bajty. Zakres: " << std::numeric_limits<short>::min() << " - " << std::numeric_limits<short>::max() << std::endl;
    std::cout << "int: " << sizeof(int) << " bajtów. Zakres: " << std::numeric_limits<int>::min() << " - " << std::numeric_limits<int>::max() << std::endl;
    std::cout << "long: " << sizeof(long) << " bajtów. Zakres: " << std::numeric_limits<long>::min() << " - " << std::numeric_limits<long>::max() << std::endl;
    std::cout << "long long: " << sizeof(long long) << " bajtów. Zakres: " << std::numeric_limits<long long>::min() << " - " << std::numeric_limits<long long>::max() << std::endl;

    std::cout << std::endl;

    std::cout << "Typy zmiennoprzecinkowe:" << std::endl;
    std::cout << "------------------------" << std::endl;
    std::cout << "float: " << sizeof(float) << " bajtów. Zakres: " << std::numeric_limits<float>::min() << " - " << std::numeric_limits<float>::max() << std::endl;
    std::cout << "double: " << sizeof(double) << " bajtów. Zakres: " << std::numeric_limits<double>::min() << " - " << std::numeric_limits<double>::max() << std::endl;
    std::cout << "long double: " << sizeof(long double) << " bajtów. Zakres: " << std::numeric_limits<long double>::min() << " - " << std::numeric_limits<long double>::max() << std::endl;

    std::cout << std::endl;

    std::cout << "Typy znakowe:" << std::endl;
    std::cout << "-------------" << std::endl;
    std::cout << "char: " << sizeof(char) << " bajtów. Zakres: " << static_cast<int>(std::numeric_limits<char>::min()) << " - " << static_cast<int>(std::numeric_limits<char>::max()) << std::endl;
    std::cout << "signed char: " << sizeof(signed char) << " bajtów. Zakres: " << static_cast<int>(std::numeric_limits<signed char>::min()) << " - " << static_cast<int>(std::numeric_limits<signed char>::max()) << std::endl;
    std::cout << "unsigned char: " << sizeof(unsigned char) << " bajtów. Zakres: 0 - " << static_cast<int>(std::numeric_limits<unsigned char>::max()) << std::endl;

    std::cout << std::endl;

    std::cout << "Typy logiczne:" << std::endl;
    std::cout << "---------------" << std::endl;
    std::cout << "bool: " << sizeof(bool) << " bajtów. Możliwe wartości: " << std::boolalpha << false << ", " << true << std::endl;

    return 0;
}