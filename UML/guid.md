This documentation describes the relationships between the entities defined in the UML diagram. The relationships include one-to-one (1-1), many-to-one (*-1), and one-to-many (1-*).

## Relationships

### 1. **User and Admin/Author**
- **Relationship Type**: One-to-One (1-1)
- **Description**: A `User` can have exactly one role, either `Admin` or `Author`. Each user is uniquely assigned a role.

### 2. **Article and User**
- **Relationship Type**: Many-to-One (*-1)
- **Description**: Many `Article` entries can be written by a single `User`. A user with the role of `Author` can write multiple articles.

### 3. **Category and Article**
- **Relationship Type**: One-to-Many (1-*)
- **Description**: A single `Category` can contain multiple `Article` entries. Each article belongs to only one category.

### 4. **Tag and Article**
- **Relationship Type**: Many-to-Many (*-*)
- **Description**: Multiple `Tag` entries can be associated with multiple `Article` entries. This relationship requires a join table to implement.
