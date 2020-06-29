#include "Error.hpp"

class ErrorMain : public Error {
public:
    ErrorMain(const std::string& msg);
    virtual ~ErrorMain() throw ();

    virtual const char* what() const throw();
private:
    const std::string _msg;
};
