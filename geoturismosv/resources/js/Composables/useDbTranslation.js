import { useI18n } from 'vue-i18n';

export function useDbTranslation() {
    const { locale } = useI18n();

    /**
     * Devuelve el valor traducido de un campo de la base de datos si existe,
     * de lo contrario devuelve el valor original en español.
     * 
     * @param {Object} model Objeto del modelo (ej. destino, categoria)
     * @param {String} field Nombre del campo base (ej. 'nombre', 'descripcion')
     * @returns {String}
     */
    const tDb = (model, field) => {
        if (!model) return '';
        
        if (locale.value === 'en') {
            const englishField = `${field}_en`;
            if (model[englishField]) {
                return model[englishField];
            }
        }
        
        return model[field] || '';
    };

    return {
        tDb
    };
}
