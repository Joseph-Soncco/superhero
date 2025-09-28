-- Vista para reporte de superhéroes con filtros de género y límite
CREATE OR REPLACE VIEW view_superhero_gender_report AS
SELECT 
    SH.id,
    SH.superhero_name,
    SH.full_name,
    SH.gender_id,
    G.gender,
    R.race,
    A.alignment,
    P.publisher_name,
    SH.height_cm,
    SH.weight_kg
FROM superhero SH
LEFT JOIN gender G ON SH.gender_id = G.id
LEFT JOIN race R ON SH.race_id = R.id
LEFT JOIN alignment A ON SH.alignment_id = A.id
LEFT JOIN publisher P ON SH.publisher_id = P.id
ORDER BY SH.superhero_name;

-- Vista para pesos promedio por editora
CREATE OR REPLACE VIEW view_weight_by_publisher AS
SELECT 
    p.publisher_name,
    AVG(s.weight_kg) as peso_promedio,
    COUNT(s.id) as total_superheroes
FROM publisher p
INNER JOIN superhero s ON p.id = s.publisher_id
WHERE p.publisher_name IS NOT NULL 
    AND p.publisher_name != ''
    AND s.weight_kg IS NOT NULL
    AND s.weight_kg > 0
GROUP BY p.id, p.publisher_name
HAVING COUNT(s.id) > 0
    AND AVG(s.weight_kg) > 0
ORDER BY peso_promedio ASC;

-- Vista para comparación de editoras por cantidad de superhéroes
CREATE OR REPLACE VIEW view_publishers_comparison AS
SELECT 
    p.publisher_name,
    COUNT(s.id) as total
FROM publisher p
LEFT JOIN superhero s ON p.id = s.publisher_id
WHERE p.publisher_name IS NOT NULL 
    AND p.publisher_name != ''
GROUP BY p.id, p.publisher_name
ORDER BY total DESC;

-- Consulta de ejemplo para verificar la vista
SELECT * FROM view_superhero_gender_report LIMIT 10;

