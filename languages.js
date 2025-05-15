const languages = {
    // Common validation messages
    validation: {
        required: {
            es: "Este campo es obligatorio",
            en: "This field is required",
            uk: "Це поле обов'язкове"
        },
        phone: {
            es: "Ingrese un número de teléfono válido",
            en: "Enter a valid phone number",
            uk: "Введіть дійсний номер телефону"
        },
        militaryId: {
            es: "Ingrese un ID militar válido",
            en: "Enter a valid military ID",
            uk: "Введіть дійсний військовий ID"
        },
        nationality: {
            es: "Seleccione una nacionalidad",
            en: "Select a nationality",
            uk: "Виберіть національність"
        },
        bloodType: {
            es: "Seleccione un grupo sanguíneo",
            en: "Select a blood type",
            uk: "Виберіть групу крові"
        },
        emergencyContact: {
            es: "Ingrese un contacto de emergencia",
            en: "Enter an emergency contact",
            uk: "Введіть контакт для екстрених випадків"
        },
        fileFormat: {
            es: "Formatos permitidos: JPG, PNG (máx. 5MB)",
            en: "Allowed formats: JPG, PNG (max 5MB)",
            uk: "Дозволені формати: JPG, PNG (макс. 5MB)"
        },
        fileSizeExceeded: {
            es: "El archivo excede el tamaño máximo permitido de 5MB",
            en: "File exceeds maximum allowed size of 5MB",
            uk: "Файл перевищує максимально допустимий розмір 5MB"
        }
    },

    es: {
        // Navigation
        nav: {
            home: "Inicio",
            register: "Registro",
            admin: "Admin",
            logout: "Salir",
            users: "Usuarios",
            soldiers: "Soldados"
        },
        // Soldier Registration
        soldier: {
            registration: "Registro de Soldado",
            view: "Ver Soldado",
            edit: "Editar Soldado",
            personalInfo: "Información Personal",
            nickname: "Nick o Apodo",
            fullName: "Nombre Completo",
            militaryId: "ID Militar",
            passport: "Número de Pasaporte",
            contact: "Información de Contacto",
            phone: "Teléfono en Ucrania",
            nationality: "Nacionalidad",
            emergency: "Contactos de Emergencia",
            emergencyContact1: "Contacto de Emergencia 1",
            emergencyPhone1: "Número de Contacto 1",
            emergencyContact2: "Contacto de Emergencia 2",
            emergencyPhone2: "Número de Contacto 2",
            military: "Información Militar",
            weaponModel: "Arma Modelo",
            weaponSerial: "N° de Serie del Arma",
            bloodType: "Grupo Sanguíneo",
            equipment: "Equipamiento",
            uniformNumber: "N° de Uniforme",
            shirtNumber: "N° de Camisa",
            bootSize: "N° de Botas (EU)",
            documents: "Documentos",
            contractDate: "Firma de Contrato",
            contractDocument: "Documento de Contrato",
            fiscalCode: "Código Fiscal",
            fiscalCodePhotos: "Fotografías del Código Fiscal",
            bankAccount: "Número de Cuenta Bancaria",
            bankAccountPhoto: "Foto del Comprobante de Cuenta Bancaria",
            passportPhoto: "Fotografía del Pasaporte",
            passportTranslationPhoto: "Fotografía de la Traducción del Pasaporte",
            save: "Guardar Registro",
            cancel: "Cancelar",
            saveSuccess: "Registro guardado exitosamente",
            saveError: "Error al guardar el registro",
            export: {
                excel: "Exportar a Excel",
                pdf: "Exportar a PDF"
            }
        }
    },
    en: {
        nav: {
            home: "Home",
            register: "Register",
            admin: "Admin",
            logout: "Logout",
            users: "Users",
            soldiers: "Soldiers"
        },
        soldier: {
            registration: "Soldier Registration",
            view: "View Soldier",
            edit: "Edit Soldier",
            personalInfo: "Personal Information",
            nickname: "Nickname",
            fullName: "Full Name",
            militaryId: "Military ID",
            passport: "Passport Number",
            contact: "Contact Information",
            phone: "Phone in Ukraine",
            nationality: "Nationality",
            emergency: "Emergency Contacts",
            emergencyContact1: "Emergency Contact 1",
            emergencyPhone1: "Contact Number 1",
            emergencyContact2: "Emergency Contact 2",
            emergencyPhone2: "Contact Number 2",
            military: "Military Information",
            weaponModel: "Weapon Model",
            weaponSerial: "Weapon Serial No.",
            bloodType: "Blood Type",
            equipment: "Equipment",
            uniformNumber: "Uniform No.",
            shirtNumber: "Shirt No.",
            bootSize: "Boot Size (EU)",
            documents: "Documents",
            contractDate: "Contract Date",
            contractDocument: "Contract Document",
            fiscalCode: "Fiscal Code",
            fiscalCodePhotos: "Fiscal Code Photos",
            bankAccount: "Bank Account Number",
            bankAccountPhoto: "Bank Account Statement Photo",
            passportPhoto: "Passport Photo",
            passportTranslationPhoto: "Passport Translation Photo",
            save: "Save Record",
            cancel: "Cancel",
            saveSuccess: "Record saved successfully",
            saveError: "Error saving record",
            export: {
                excel: "Export to Excel",
                pdf: "Export to PDF"
            }
        }
    },
    uk: {
        nav: {
            home: "Головна",
            register: "Реєстрація",
            admin: "Адмін",
            logout: "Вийти",
            users: "Користувачі",
            soldiers: "Солдати"
        },
        soldier: {
            registration: "Реєстрація солдата",
            view: "Перегляд солдата",
            edit: "Редагування солдата",
            personalInfo: "Особиста інформація",
            nickname: "Позивний",
            fullName: "Повне ім'я",
            militaryId: "Військовий ID",
            passport: "Номер паспорта",
            contact: "Контактна інформація",
            phone: "Телефон в Україні",
            nationality: "Національність",
            emergency: "Екстрені контакти",
            emergencyContact1: "Екстрений контакт 1",
            emergencyPhone1: "Номер контакту 1",
            emergencyContact2: "Екстрений контакт 2",
            emergencyPhone2: "Номер контакту 2",
            military: "Військова інформація",
            weaponModel: "Модель зброї",
            weaponSerial: "Серійний номер зброї",
            bloodType: "Група крові",
            equipment: "Спорядження",
            uniformNumber: "Номер форми",
            shirtNumber: "Номер сорочки",
            bootSize: "Розмір взуття (EU)",
            documents: "Документи",
            contractDate: "Дата контракту",
            contractDocument: "Документ контракту",
            fiscalCode: "Фіскальний код",
            fiscalCodePhotos: "Фотографії фіскального коду",
            bankAccount: "Номер банківського рахунку",
            bankAccountPhoto: "Фото виписки з банківського рахунку",
            passportPhoto: "Фото паспорта",
            passportTranslationPhoto: "Фото перекладу паспорта",
            save: "Зберегти запис",
            cancel: "Скасувати",
            saveSuccess: "Запис успішно збережено",
            saveError: "Помилка збереження запису",
            export: {
                excel: "Експорт в Excel",
                pdf: "Експорт в PDF"
            }
        }
    }
};

// Language switcher function
function switchLanguage(lang) {
    localStorage.setItem('preferredLanguage', lang);
    updatePageLanguage();
}

// Update page content based on selected language
function updatePageLanguage() {
    const lang = localStorage.getItem('preferredLanguage') || 'es';
    
    // Update all elements with data-lang attribute
    document.querySelectorAll('[data-lang]').forEach(element => {
        const path = element.getAttribute('data-lang').split('.');
        
        // Handle validation messages differently
        if (path[0] === 'validation') {
            const message = languages.validation[path[1]][lang];
            if (message) {
                element.textContent = message;
            }
            return;
        }

        // Handle regular translations
        let text = languages[lang];
        path.forEach(key => {
            if (text) text = text[key];
        });
        
        if (text) {
            if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
                element.placeholder = text;
            } else {
                element.textContent = text;
            }
        }
    });

    // Update current language display
    const currentLangDisplay = document.getElementById('currentLanguage');
    if (currentLangDisplay) {
        currentLangDisplay.textContent = lang.toUpperCase();
    }
}
