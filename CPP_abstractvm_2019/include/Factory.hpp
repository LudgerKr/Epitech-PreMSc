#ifndef FACTORY_HPP
#define FACTORY_HPP

#include "Error.hpp"
#include "IOperand.hpp"
#include "Operand.hpp"
#include "Type/Double.hpp"
#include "Type/Float.hpp"
#include "Type/Int8.hpp"
#include "Type/Int16.hpp"
#include "Type/Int32.hpp"
#include "Type/BigDecimal.hpp"
#include <map>

class Factory {
public:
    Factory();
    Factory(const Factory&);
    ~Factory();
	const Factory& operator=(const Factory&);

    /* FUNCTION WHO CALL THE CREATION OF FUNCTION TYPE */
    const IOperand *createOperand(eOperandType type, const std::string& value) const;

private:
    /* FUNCTIONS FOR CREATING DIFFERENTS TYPE */
    const IOperand *createInt8(const std::string& value) const;
    const IOperand *createInt16(const std::string& value) const;
    const IOperand *createInt32(const std::string& value) const;
    const IOperand *createFloat(const std::string& value) const;
    const IOperand *createDouble(const std::string& value) const;
	const IOperand *createBigDecimal(const std::string& value) const;

    class FactoryError : public Error {
    public:
        FactoryError(const std::string& msg)
        : _msg(msg), Error() 
        {

        }
        virtual ~FactoryError() throw () {}
        virtual const char* what() const throw() {
            return (_msg.c_str());
        }
    private:
        const std::string _msg;
    };

    /*  MAP OF POINTER MEMBER FUNCTION */
	std::map<eOperandType, const IOperand *(Factory::*)(const std::string& value) const> _createType;
};

#endif /* FACTORY_HPP_ */