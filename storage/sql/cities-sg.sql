insert into cities(description, code, state_id, created_at, updated_at, created_by, updated_by) 
Select
a.description, a.code,  s.id, a.created_at, a.updated_at, a.created_by, a.updated_by
from
(
Select '' as description, '' as regCode, '' as provCode, '' as code, '' as created_at, '' as updated_at, '' as created_by, '' as updated_by union all
Select 'Bukit Merah', 'SG-01', '01', '01', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Toa Payoh', 'SG-01', '02', '02', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Geylang', 'SG-01', '03', '03', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Kallang', 'SG-01', '04', '04', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Queenstown', 'SG-01', '05', '05', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Bishan', 'SG-01', '06', '06', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Bukit Timah', 'SG-01', '07', '07', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Marine Parade', 'SG-01', '08', '08', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Novena', 'SG-01', '09', '09', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Outram', 'SG-01', '10', '10', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Tanglin', 'SG-01', '11', '11', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Rochor', 'SG-01', '12', '12', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'River Valley', 'SG-01', '13', '13', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Newton', 'SG-01', '14', '14', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Downtown Core', 'SG-01', '15', '15', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Singapore River', 'SG-01', '16', '16', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Southern Islands', 'SG-01', '17', '17', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Orchard', 'SG-01', '18', '18', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Museum', 'SG-01', '19', '19', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Marina East', 'SG-01', '20', '20', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Marina South', 'SG-01', '21', '21', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Straits View', 'SG-01', '22', '22', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Bedok', 'SG-02', '23', '23', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Tampines', 'SG-02', '24', '24', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Pasir Ris', 'SG-02', '25', '25', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Changi', 'SG-02', '26', '26', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Paya Lebar', 'SG-02', '27', '27', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Changi Bay', 'SG-02', '28', '28', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Woodlands', 'SG-03', '29', '29', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Yishun', 'SG-03', '30', '30', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Sembawang', 'SG-03', '31', '31', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Mandai', 'SG-03', '32', '32', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Sungei Kadut', 'SG-03', '33', '33', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Lim Chu Kang', 'SG-03', '34', '34', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Central Water Catchment', 'SG-03', '35', '35', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Simpang', 'SG-03', '36', '36', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Hougang', 'SG-04', '37', '37', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Sengkang', 'SG-04', '38', '38', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Ang Mo Kio', 'SG-04', '39', '39', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Serangoon', 'SG-04', '40', '40', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Punggol', 'SG-04', '41', '41', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Seletar', 'SG-04', '42', '42', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'North-Eastern Islands', 'SG-04', '43', '43', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Jurong West', 'SG-05', '44', '44', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Choa Chu Kang', 'SG-05', '45', '45', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Bukit Batok', 'SG-05', '46', '46', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Bukit Panjang', 'SG-05', '47', '47', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Clementi', 'SG-05', '48', '48', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Jurong East', 'SG-05', '49', '49', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Western Water Catchment', 'SG-05', '50', '50', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Pioneer', 'SG-05', '51', '51', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Tuas', 'SG-05', '52', '52', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Boon Lay', 'SG-05', '53', '53', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Tengah', 'SG-05', '54', '54', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1 union all
Select 'Western Islands', 'SG-05', '55', '55', '2022-10-30 15:14:36','2022-10-30 15:14:36',1,1

) a 
join states s on s.code = a.regCode
where a.code <> '';