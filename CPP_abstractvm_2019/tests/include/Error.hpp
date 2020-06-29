#ifndef ERROR_HPP
#define ERROR_HPP

#include <iostream>
#include <exception>

class Error : public std::exception {
public:
    Error() {};
    Error(const Error&);
    virtual ~Error() throw () {};

    const Error& operator=(const Error&);
    virtual const char* what() const throw() { return _msg.c_str(); }
private:
    std::string _msg;
};

#endif /* ERROR_HPP_ */