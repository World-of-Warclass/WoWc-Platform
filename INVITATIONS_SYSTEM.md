# Sistema de Invitaciones - WoWc Platform

## ¿Cómo funciona el sistema de invitaciones?

El sistema de invitaciones permite a los profesores (masters) crear códigos de invitación para que los estudiantes se unan a sus cursos de forma segura.

### Para el Profesor (Master):

1. **Crear una invitación:**
   - Navegar a: `/main/{token}/master/create-invitation`
   - Completar el formulario con:
     - Nombre del estudiante
     - Email (opcional)
   - Al crear la invitación, se genera un código único

2. **Ver todas las invitaciones:**
   - Navegar a: `/main/{token}/master/invitations`
   - Ver lista de todas las invitaciones del curso
   - Estados: "Pendiente" o "Utilizada"
   - Copiar códigos de invitación

### Para el Estudiante:

1. **Usar una invitación:**
   - Iniciar sesión en la plataforma
   - En el dashboard, hacer clic en "Unirse a una clase"
   - Introducir el código de invitación proporcionado por el profesor
   - El sistema automáticamente:
     - Verifica que el código sea válido
     - Verifica que no esté ya utilizado
     - Verifica que el estudiante no esté ya inscrito
     - Crea la inscripción al curso
     - Marca la invitación como utilizada

### Flujo Técnico:

1. **Creación del código:** `base64_encode($invitation->name . '&' . $invitation->id)`
2. **Validación:** El controlador `InscriptionController` busca la invitación por código
3. **Inscripción:** Se crea un registro en la tabla `inscriptions`
4. **Marcado:** La invitación se marca como `used = true`

### URLs importantes:

- **Crear invitación:** `/main/{token}/master/create-invitation`
- **Lista de invitaciones:** `/main/{token}/master/invitations`
- **Validar invitación:** `/validation-inscription` (POST)

### Características de seguridad:

- Cada código es único
- Los códigos solo se pueden usar una vez
- Se verifica que el usuario no esté ya inscrito
- Se valida la existencia del curso
- Manejo de errores y mensajes informativos
