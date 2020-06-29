#ifndef OPERAND_HPP_
#define OPERAND_HPP_

#include "IOperand.hpp"
#include "Error.hpp"
#include <iostream>
#include <limits>
#include <sstream>
#include <memory>

template <typename T>
class Operand : public IOperand {
public:
    Operand(const std::string& value, eOperandType type, ePrecision precision);
    Operand(const Operand&);
    Operand();
    ~Operand();
	const Operand& operator=(const Operand&);

    std::string toString() const {
        return (this->_value);
    }

    ePrecision getPrecision() const {
        return (this->_precision);
    }

    eOperandType getType() const {
        return (this->_type);
    }

    /* OPERATOR OVERLOAD */
    const IOperand *operator+(const IOperand& rhs) const; 
    const IOperand *operator-(const IOperand& rhs) const;
    const IOperand *operator*(const IOperand& rhs) const; 
    const IOperand *operator/(const IOperand& rhs) const; 
    const IOperand *operator%(const IOperand& rhs) const;

    /* OVERFLOW HANDLING */
    const void getRhsOverflow(std::string valueResult, const IOperand& rhs) const;
    const void getThisOverflow(std::string valueResult) const;


private:
    class OperandError : public Error {
    public:
        OperandError(const std::string& msg)
        : _msg(msg), Error() 
        {

        }
        virtual ~OperandError() throw () {}

        virtual const char* what() const throw() {
            return (_msg.c_str());
        }
    private:
        const std::string _msg;
    };

    eOperandType _type;
    std::string _value;
    ePrecision _precision;
};

/* TEMPLATE OF DIFFERENTS TYPE */
template class Operand<char>;
template class Operand<int16_t>;
template class Operand<int32_t>;
template class Operand<float>;
template class Operand<double>;
template class Operand<int64_t>;

#endif /* OPERAND_HPP_ */
