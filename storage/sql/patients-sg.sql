insert into patients(id, branch_id, first_name, last_name, birth_date, gender_id, nric, mobile_number, email, created_at, updated_at, created_by, updated_by)
Select
a.id,
1 as branchId,
a.firstName,
a.lastName,
a.birthDate,
g.id as genderId,
a.nric,
a.mobile,
case when a.email = '' then null else a.email end as email,
'2022-10-30 15:14:36','2022-10-30 15:14:36',1,1
from (
Select 0 as id, '' as firstName, '' as lastName, '' as birthDate, '' as Gender, '' as NRIC, '' as mobile, '' as email union all
Select 1, 'Aileen', 'Campos', '1989-12-07', 'Female', 'GXXX9664K', '97507542', 'aileencampos7@gmail.com' union all
Select 2, 'Jing Becky', 'Yang', '1984-04-21', 'Female', 'SXXX3123Z', '86111360', '' union all
Select 3, 'Syauqina Binte Kassim', 'Nur', '1999-04-27', 'Female', 'SXXX2355I', '91541703', 'syaumao@gmail.com' union all
Select 4, 'Yi Han Agnes', 'Lee', '1987-06-21', 'Female', 'SXXX8882E', '88637818', 'agn3s1ee@icloud.com' union all
Select 5, 'Khai Cheng Hedy', 'Tan', '1990-12-23', 'Female', 'SXXX3148C', '91451519', 'hedy1223@hotmail.com' union all
Select 6, 'Chie', 'Thomas', '1970-12-22', 'Female', 'GXXX5433M', '87225906', 'chiewarren@hotmail.com' union all
Select 7, 'Angela', 'Campos', '1995-05-21', 'Female', 'GXXX6172Q', '85691261', 'anjcamposss@gmail.com' union all
Select 8, 'Jiang (Angelina)', 'Ivanka', '1986-04-16', 'Female', 'SXXX5060J', '98881368', '' union all
Select 9, 'Miriam Grace Descatamiento', 'Punsalan', '1983-03-04', 'Female', 'GXXX1159M', '87126944', 'minian2103@yahoo.com' union all
Select 10, 'Rodara Ubate', 'Castillo', '1973-06-13', 'Female', 'GXXX9612Q', '94998572', '' union all
Select 11, 'Xueyi', 'Hu', '1985-12-12', 'Female', 'SXXX8956D', '92788862', 'huxueyi85@gmail.com' union all
Select 12, 'Shi Hui Amber', 'Wong', '1993-01-13', 'Female', 'SXXX2453B', '93272661', 'shuhui777@hotmail.com' union all
Select 13, 'Si Wen Clara', 'Goh', '1993-07-20', 'Female', 'SXXX5203I', '96491307', 'siwengoh@gmail.com' union all
Select 14, 'Chow Pei Yi', 'Baby', '1983-09-13', 'Female', 'SXXX8597D', '91905505', 'babychowbaby@gmail.com' union all
Select 15, 'DCA - Orchard', '', '1972-07-10', 'Male', 'SXXX5901A', '', '' union all
Select 16, 'Shao', 'Kevin', '1970-01-09', 'Male', 'SXXX8145D', '89158314', 'shao.kevin@gmail.com' union all
Select 17, 'Peak Geok (Angel)', 'Goh', '1977-09-09', 'Female', 'SXXX6379G', '91919970', 'algohsky@yahoo.com' union all
Select 18, 'Beiwen (Anna)', 'Du', '1973-10-04', 'Female', 'SXXX4278F', '90694198', '' union all
Select 19, 'Ma Theresa Leona Tekiko', 'Bautista', '1982-01-22', 'Female', 'GXXX2086L', '89236803', 'kirstenkarl29@gmail.com' union all
Select 20, 'Xuan', 'Liu', '1987-01-25', 'Female', 'SXXX6425G', '98894069', 'liuxuanspy@hotmail.com' union all
Select 21, 'Mu Thant', 'Mu', '1975-06-19', 'Female', 'GXXX1087Q', '81549540', 'mumu197519@gmail.com' union all
Select 22, 'Miao Miao', 'Fan', '1981-12-05', 'Female', 'SXXX3199C', '90904852', 'value512@yahoo.com' union all
Select 23, 'Ho Set Yee', 'Angela', '1981-08-06', 'Female', 'SXXX5481E', '98489011', 'rainrain_day@yahoo.com' union all
Select 24, 'Phui Chun (Lala)', 'Chong', '1968-10-25', 'Female', 'FXXX6460X', '84684840', '' union all
Select 25, 'Paula Marie', 'Barnes', '1973-10-25', 'Female', 'GXXX9872R', '83893466', 'paulamariebarnes@gmail.com' union all
Select 26, 'Wen Yan (Leanne)', 'Lie', '1993-02-20', 'Female', 'GXXX9361Q', '92322373', '' union all
Select 27, 'Yap Jin Ping', 'Amanda', '1984-02-29', 'Female', 'SXXX6290A', '98179229', 'amanda@creasia.10' union all
Select 28, 'Lynne Chen Huiling', 'Kelly', '1981-06-23', 'Female', 'SXXX8922F', '90617660', 'xbootylicious81x@gmail.com' union all
Select 29, 'Zhi Qi', 'Lee', '1996-08-07', 'Female', 'SXXX3827D', '97511352', 'janettolzq@gmail.com' union all
Select 30, 'Fely Rivero', 'Repol', '1988-04-29', 'Female', 'GXXX4020M', '86917517', '' union all
Select 31, 'Yanqiu', 'Gong', '1982-08-14', 'Female', 'GXXX3937N', '90163140', 'GYQ@hotmail.sg' union all
Select 32, 'Jing (Rebecca)', 'Ma', '1983-01-23', 'Female', 'SXXX3228B', '98623621', '' union all
Select 33, 'Menglin', 'Zou', '1990-03-24', 'Female', 'SXXX8662H', '83034261', 'zml998833@gmail.com' union all
Select 34, 'Limei (Julia)', 'Han', '1980-05-21', 'Female', 'SXXX6654H', '91729634', '' union all
Select 35, 'Ying Amanda', 'Xu', '1983-11-18', 'Female', 'SXXX4720E', '86912369', 'yingxu@hotmail.co.uk' union all
Select 36, 'Loh Pei Xin', 'Batricia', '1991-12-04', 'Female', 'FXXX5548R', '85910536', 'batricialoh@hotmail.com' union all
Select 37, 'Koh Ning', 'Azalea', '1996-11-07', 'Female', 'SXXX4535A', '91145543', '' union all
Select 38, 'Jhung Meng Bryan', 'Koh', '1994-03-24', 'Male', 'SXXX1265F', '82874623', '' union all
Select 39, 'Karunanethi', 'Kumuthatharseeni', '1993-03-19', 'Female', 'GXXX9889L', '87404613', 'KUMUTHA1903@GMAIL.COM' union all
Select 40, 'Li Xuan (Ann)', 'Liu', '1970-04-16', 'Female', 'SXXX0401C', '91760053', '' union all
Select 41, 'Lee Wei (Joan)', 'Liu', '1974-11-17', 'Female', 'GXXX2938L', '84051922', 'Joan.leewei99@gmail.com' union all
Select 42, 'Shaofen', 'Zeng', '1990-10-09', 'Female', 'GXXX4540Q', '88900250', '' union all
Select 43, 'Teo', 'Floris', '1969-04-16', 'Female', 'SXXX3929I', '80288342', 'floristeo@yahoo.com' union all
Select 44, 'Yiyun (Erin)', 'Li', '1989-04-08', 'Female', 'GXXX5857K', '88699786', 'lshieve.et@gmail.com' union all
Select 45, 'Lu (Ruby)', 'Huang', '1988-02-13', 'Female', 'SXXX6566D', '97931173', 'aluruby@gmail.com' union all
Select 46, 'Peng Hee Augustine', 'Lim', '1972-07-14', 'Male', 'SXXX4283A', '96941606', 'augustine.mail@gmail.com' union all
Select 47, 'Lim', 'Susan', '1972-01-25', 'Female', 'SXXX3236E', '91110125', 'STARS2425@HOTMAIL.COM' union all
Select 48, 'Elma Casilla', 'Carino', '1989-09-17', 'Female', 'GXXX8138K', '80400016', 'elmacarino8089@gmail.com' union all
Select 49, 'Kaw An (Kris)', 'Yip', '1974-10-17', 'Female', 'SXXX0641Z', '96507173', 'yip_kris@yahoo.com.sg' union all
Select 50, 'Ailada', 'Renzentes', '1983-07-20', 'Female', 'SXXX6274C', '90688307', 'ailadare88@gmail.com' union all
Select 51, 'Khai Xin', 'Tan', '1997-07-08', 'Female', 'GXXX5366U', '84265892', 'kxin8776@gmail.com' union all
Select 52, 'Li Hui Valerie', 'Tan', '2000-05-19', 'Female', 'TXXX6353D', '88306353', 'valeria.cherrypink@gmail.com' union all
Select 53, 'Foong Meng (Jasmine)', 'Chan', '1954-07-11', 'Female', 'SXXX2085Z', '93628889', '' union all
Select 54, 'Aik Sai', 'Hong', '1955-12-29', 'Male', 'FXXX5977U', '96333398', '' union all
Select 55, 'Chee Khean', 'Yap', '1977-06-02', 'Male', 'SXXX7332E', '91737175', '' union all
Select 56, 'Renz Carl Llido', 'Amora', '1990-02-10', 'Male', 'GXXX1054P', '85301685', 'renzcarlamora1990@gmail.com' union all
Select 57, 'Raseca Glecy Llido', 'Amora', '1987-08-15', 'Female', 'GXXX3784W', '84687439', 'glecy_amora@yahoo.com' union all
Select 58, 'Rongrong', 'Wang', '1982-01-23', 'Female', 'GXXX8399K', '91683603', 'rongrongw1@outlook.com' union all
Select 59, 'Meng Lee (Jennifer)', 'Tan', '1993-08-15', 'Female', 'SXXX2677D', '81187899', 'jennifertan15@gmail.com' union all
Select 60, 'Buenavides', 'Debbie', '1989-05-17', 'Female', 'GXXX0287Q', '86080753', 'debbiebuenavides89@gmail.com' union all
Select 61, 'Kristinne Lori Sayas', 'Reyes', '1989-05-16', 'Female', 'GXXX6658T', '85301695', 'klreyes0516@gmail.com' union all
Select 62, 'Leo Angelo San Joses', 'Listana', '1983-03-22', 'Male', 'GXXX2140T', '81814038', 'leargelo_listara@yahoo.com' union all
Select 63, 'Madonna Guerrero', 'Bumanlag', '1986-06-09', 'Female', 'GXXX9348L', '89269047', 'bumanlagmadonna115@gmail.com' union all
Select 64, 'Ellen Joy Babiera', 'Navarrete', '1989-10-27', 'Female', 'GXXX4861W', '85301705', 'jhoyzz122705@gmail.com' union all
Select 65, 'Marina Christia Oarge', 'Antonio', '1989-06-20', 'Female', 'GXXX0628R', '81177126', 'angel_christia@yahoo.com' union all
Select 66, 'He', 'Mia', '1989-08-11', 'Female', 'SXXX3108C', '91016455', 'hewanyingmia_1989@hotmail.sg' union all
Select 67, 'Winarti', '', '1986-08-21', 'Female', 'GXXX2399M', '91484773', 'winnawinarti5@gmail.com' union all
Select 68, 'Anna', 'Kulish', '1987-03-18', 'Female', 'GXXX3875W', '91999806', 'get_2ania@hotmail.com' union all
Select 69, 'Bing', 'Zhou', '1973-11-20', 'Female', 'GXXX9098N', '90294126', '1538090925@gg.com' union all
Select 70, 'Ngwe Zin Tun', 'Htike', '1987-10-07', 'Female', 'GXXX1242U', '86801962', '' union all
Select 71, 'Liew Yun Fui', 'Annie', '1974-02-23', 'Female', 'SXXX9697D', '93909302', 'liewyunfui@yahoo.com' union all
Select 72, 'Lundeihchingi', '', '1992-05-02', 'Female', 'GXXX3059N', '86203351', 'ldfebruary93@gmail.com' union all
Select 73, 'Rualtinchhingi', '', '1988-07-04', 'Female', 'GXXX7297L', '91609924', 'chhingfuali19@gmail.com' union all
Select 74, 'Lalnunsiami', 'Juliana', '1997-12-08', 'Female', 'GXXX8722T', '91049640', 'julianachhangte@gmail.com' union all
Select 75, 'Patrick Wager', 'Stephen', '1989-04-18', 'Male', 'SXXX5434I', '91880079', 'sporager@gmail.com' union all
Select 76, 'Wong', 'Rykiel', '1984-09-14', 'Female', 'SXXX7645I', '92321912', 'Ryki3L@gmail.com' union all
Select 77, 'Lalhriatchhungi', '', '1991-12-23', 'Female', 'GXXX0952T', '82962542', 'nunuikimfanai@gmail.com' union all
Select 78, 'Kristine Sebastian', 'Quinto', '1989-02-23', 'Female', 'GXXX0728Q', '85301725', 'qskristine16@gmail.com' union all
Select 79, 'Escalera Japson', 'Rafaez', '1989-05-22', 'Male', 'PXXX8397B', '85301685', 'rafaeljapson08@gmail.com' union all
Select 80, 'Pei Wen', 'Ng', '1985-06-14', 'Female', 'SXXX8726J', '81271668', 'ngpeiwen@hotmail.com' union all
Select 81, 'Yi Rong Eileen', 'Ng', '1988-07-07', 'Female', 'SXXX3025F', '98234081', 'eiyuki_acewin@hotmail.com' union all
Select 82, 'Daniel Badoy', 'Yupangco', '1987-02-08', 'Male', 'GXXX5788U', '93843687', '' union all
Select 83, 'Javier', 'Melissa', '1989-11-14', 'Female', 'GXXX1060M', '97317969', 'melsjavier@gmail.com' union all
Select 84, 'Leon Shiela Lucile Lim', 'De', '1984-01-12', 'Female', 'GXXX2379M', '93214307', 'shielalucile02@gmail.com' union all
Select 85, 'Xiaoru Sherry', 'Gao', '1976-01-15', 'Female', 'SXXX4383Z', '93233158', 'gaosherry@yahoo.com.sg' union all
Select 86, 'Yan', 'Xu', '1982-05-14', 'Female', 'SXXX4313C', '98275126', 'anniekoh.xuyan@gmail.com' union all
Select 87, 'Yeoh Wuan Chiann', 'Crystal', '1992-06-23', 'Female', 'SXXX9700G', '90535177', 'crystal_yeoh@hotmail.com' union all
Select 88, 'Kou Kar Chong', 'Nigel', '2002-02-20', 'Male', 'TXXX0024C', '88637718', 'nigelkou@gmail.com' union all
Select 89, 'Poh Hoon Veronica', 'Lim', '1978-07-22', 'Female', 'SXXX3274A', '90013672', '' union all
Select 90, 'Reca Ba-at', 'Corroz', '1988-11-20', 'Female', 'GXXX6120P', '88049581', 'recafagi@gmail.com' union all
Select 91, 'Zin Htet', 'Phyo', '1985-08-29', 'Male', 'SXXX5762H', '90679749', 'flora_huang29@hotmail.com' union all
Select 92, 'Glena Suminguit Rivera', 'Ma', '1985-02-13', 'Female', 'GXXX7792P', '93465344', 'glen_girl02@gmail.com' union all
Select 93, 'Anastasia', 'Tsygankova', '1974-10-31', 'Female', '7X43435', '817033000000', 'ANASTASIA.TSYGANKOVA@gmail.com' union all
Select 94, 'Wu Yu Shan', 'Betty', '1999-09-19', 'Female', 'GXXX2302W', '80380314', 'wu731222730@icloud.com' union all
Select 95, 'Molika', 'Sam', '1993-03-26', 'Female', 'SXXX6567B', '90229902', 'navylika10@gnail.com' union all
Select 96, 'Li Noi Cyndi', 'Koh', '1975-12-30', 'Female', 'SXXX9114E', '96820223', 'myeidong@yahoo.com.sg' union all
Select 97, 'Chew Ping Julie', 'Yue', '1967-07-20', 'Female', 'SXXX4881F', '96354283', 'julieyuechewping@yahoo.com.sg' union all
Select 98, 'Kee Wah', 'Kou', '1969-09-28', 'Male', 'SXXX5860F', '98607083', '' union all
Select 99, 'Zai Guo', 'Song', '1960-08-20', 'Male', '6XX62978', '86139000000000', '' union all
Select 100, 'Goh Su Yin', 'Joyce', '1985-08-15', 'Female', 'SXXX0962C', '98211682', '' union all
Select 101, 'Marion', 'Sposito', '1986-02-28', 'Female', 'GXXX6317P', '86852208', 'marion.sposite@hotmail.com.fn' union all
Select 102, 'Owen Francisco De Jesus', 'Gabriel', '2002-03-29', 'Male', 'TXXX8798C', '96884987', '' union all
Select 103, 'Hannah Joy Publico', 'Macunal', '1995-04-06', 'Female', 'GXXX8149R', '97588849', 'hannahmacunal@gmail.com' union all
Select 104, 'Hui Xing Wendy', 'Chua', '1977-12-30', 'Female', 'SXXX7360H', '90018860', 'chxin77@yahoo.com' union all
Select 105, 'Low Kit', 'Wong', '1962-02-17', 'Female', 'SXXX4370G', '96643687', '' union all
Select 106, 'Siswati', 'Denis', '1989-08-28', 'Female', 'GXXX0045M', '91749027', '' union all
Select 107, 'Shuai Kyle', 'Zhang', '1987-12-04', 'Male', 'GXXX1034X', '88046216', 'sh2h421@gmail.com' union all
Select 108, 'Tricia Odvina', 'Jao', '1978-02-13', 'Female', 'GXXX1269T', '86282720', 'tricia.odvina@gmail.com' union all
Select 109, 'Kavitha', '', '1981-01-04', 'Female', 'GXXX6645W', '92313576', '' union all
Select 110, 'Xin Yi', 'Teng', '2000-07-11', 'Female', 'TXXX1764E', '81812943', 'xinyiteng2000@gmail.ccom' union all
Select 111, 'Tan Lee Yu', 'Kyoshirocaeden', '1987-03-06', 'Male', 'SXXX7796C', '96391682', 'caedentan8787@gmail.com' union all
Select 112, 'Diana Rose Pichay', 'Evangelista', '1985-10-07', 'Female', 'PXXX7818B', '82659620', '' union all
Select 113, 'S/O Maniraja', 'Thineswaran', '1995-08-22', 'Male', 'SXXX0211A', '87600131', '' union all
Select 114, 'Dr Chio Aesthetic And Laser Centre Pte Ltd', '', '1945-12-19', 'Male', 'SXXX5214H', '', '' union all
Select 115, 'Bin Abd Latif', 'Nooresham', '2019-03-08', 'Male', 'SXXX7483H', '90469003', '' union all
Select 116, 'Li Ching Kimberly', 'Tan', '1995-03-20', 'Female', 'SXXX0121F', '98550039', 'kimberlytlcx@gmail.com' union all
Select 117, 'Mei Zhuang Victoria', 'Yeo', '1990-09-12', 'Female', 'SXXX2422J', '98581080', '' union all
Select 118, 'Lai Peng Elynn', 'Hooi', '1974-05-13', 'Female', 'SXXX5149C', '92372656', 'elynnhooi@yahoo.com.sg' union all
Select 119, 'Hui Ru Grace', 'Tan', '1990-07-23', 'Female', 'SXXX3731A', '97948834', '' union all
Select 120, 'Julius', 'Shally', '1987-09-18', 'Female', 'SXXX5662I', '90029897', '' union all
Select 121, 'Lai Keng', 'Chu', '1934-01-01', 'Male', 'SXXX3484J', '98574850', '' union all
Select 122, 'Bedok Clinic Pte Ltd', 'Famicare', '2006-01-01', 'Female', 'CXMPANY', '', '' union all
Select 123, 'Li Ting Jeanna', 'Song', '1978-10-16', 'Female', 'SXXX0470G', '84986581', '' union all
Select 124, 'Dr Chio Aesthetic Philippine Branch', '', '2012-01-01', 'Female', 'PXXXXXPINES', '', '' union all
Select 125, 'Abringe', 'Junelle', '1993-10-02', 'Female', 'SXXX4316D', '85713650', 'nel_abringe@hotmail.com' union all
Select 126, 'Yun Xuan Sherlyn', 'Goh', '2001-05-10', 'Female', 'TXXX0732G', '91687627', 'sherlyngy@gmail.com' union all
Select 127, 'Chanduongdav Fairy', 'Ban', '1992-10-26', 'Female', 'SXXX6206H', '97707447', '' union all
Select 128, 'Chen Wye Yuen', 'Gary', '1970-07-21', 'Male', 'SXXX7503A', '96808777', '' union all
Select 129, 'Chui Peng Cassandra', 'Goh', '1974-01-13', 'Female', 'SXXX2171I', '90903230', '' union all
Select 130, 'Sch Ling (Joycelyn)', 'Ng', '1983-08-29', 'Female', 'SXXX3669F', '96570465', 'joycelynsl@yahoo.com' union all
Select 131, 'Gines Francisco', 'Allea', '1981-12-29', 'Female', 'GXXX3888N', '83225809', 'alleagfrancisco@gmail.com' union all
Select 132, 'Tan Ke Jia', 'Shuan', '1999-08-27', 'Male', 'SXXX6816F', '96791481', '' union all
Select 133, 'Wei Yi Steffi', 'Phua', '1990-05-29', 'Female', 'SXXX9598J', '91391511', '' union all
Select 134, 'Kwai Fung Katherine', 'Yew', '1973-03-25', 'Female', 'SXXX9353H', '98153233', '' union all
Select 135, 'Yue Mun Yee', 'Adriana', '1979-07-04', 'Female', 'SXXX9206A', '87753191', '' union all
Select 136, 'Swee Hong', 'Lim', '1977-09-09', 'Male', 'SXXX7378F', '94517130', '' union all
Select 137, 'John Patrick Valeroso', 'Tanguamos', '1989-11-16', 'Male', 'GXXX0969R', '88940669', 'jpvtangnamos@gmail.com' union all
Select 138, 'Ella Guevarra', 'Shipley', '1980-08-20', 'Female', 'GXXX1270U', '83850582', '' union all
Select 139, 'Jean', 'Lai', '1981-12-09', 'Female', 'GXXX2341P', '88185055', '' union all
Select 140, 'Lian Hong Maggie', 'Tee', '1971-05-08', 'Female', 'SXXX4398Z', '93685356', '' union all
Select 141, 'Kuar', 'Indarjeet', '1956-07-24', 'Female', 'SXXX4734F', '98169540', '' union all
Select 142, 'Lee Pei Pei', 'Linda', '1971-02-13', 'Female', 'SXXX5635Z', '96868080', '' union all
Select 143, 'Hie Min Kristine', 'Wong', '1976-07-28', 'Female', 'SXXX6782C', '96357191', 'kristinewong76@yahoo.com' union all
Select 144, 'Li Jia Grace', 'Yang', '1994-12-28', 'Female', 'SXXX8848F', '85699711', 'bittersweet-gal@hotmail.com' union all
Select 145, 'Gina Udto', 'Walker', '1984-03-10', 'Female', 'GXXX7528W', '83226514', '' union all
Select 146, 'Hui Yin', 'Sin', '1987-04-24', 'Female', 'SXXX6929A', '96501596', 'shyin87@hotmail.com' union all
Select 147, 'Tan Wee Lin', 'Angela', '1973-05-08', 'Female', 'SXXX7733G', '92988265', 'angeltanwl@yahoo.com' union all
Select 148, 'Lei Chiew Hong', 'Diana', '1975-07-05', 'Female', 'SXXX1268J', '90600245', 'dianalch110@hotmail.com' union all
Select 149, 'Alconera', 'Melody', '1976-12-11', 'Female', 'GXXX6079N', '84420084', 'nelodyalconera@yahoo.com' union all
Select 150, 'Thi Bich Nga Emma', 'Vu', '1979-06-11', 'Female', 'SXXX0141J', '90906757', '' union all
Select 151, 'Zi Lin Levon', 'Lim', '1991-11-26', 'Male', 'SXXX4370H', '90300718', 'ziilin91@hotmail.com' union all
Select 152, 'Xiong', 'Joanne', '1977-02-16', 'Female', 'SXXX3263B', '96893333', '' union all
Select 153, 'Tan', 'Nancy', '1973-10-08', 'Female', 'SXXX8745J', '98328529', 'brighteasteon@yahoo.com.sg' union all
Select 154, 'Janeth Kamos', 'Agustin', '1989-11-08', 'Female', 'GXXX3807M', '93714014', 'whtlghir09@yahoo.com.ph' union all
Select 155, 'Sheiren Sumaiku', 'Imelda', '1978-11-20', 'Female', 'SXXX3631I', '98327400', '' union all
Select 156, 'Victoria Ang', 'Chloe', '1993-09-23', 'Female', 'SXXX6962I', '84988501', 'chloeheng.v@gmail.com' union all
Select 157, 'Chian Yee Joey', 'Lee', '1989-12-25', 'Female', 'SXXX3163F', '81633155', 'joey.cyeelee@gmail.com' union all
Select 158, 'You Ching', 'Choo', '1993-07-08', 'Female', 'SXXX9029A', '82221985', 'thebeigebear@live.com' union all
Select 159, 'Binte Amir Hamzah', 'Ratina', '1988-06-08', 'Female', 'SXXX9940E', '88528308', 'tinabunson@gmail.com' union all
Select 160, 'Win Ting', 'Lock', '1988-06-22', 'Female', 'SXXX0089D', '81689742', '' union all
Select 161, 'Yi Ning Jasmine', 'Tan', '1995-07-18', 'Female', 'SXXX5191I', '91263947', 'heyjasjas@gmail.com' union all
Select 162, 'Ep Buehler Heloise', 'Ghipponi', '1980-02-28', 'Female', 'GXXX4094R', '96653122', 'HGHIPPONI@HOTMAIL.COM' union all
Select 163, 'Manling Gelista', 'Chee', '1981-01-10', 'Female', 'SXXX2322D', '88770047', 'gelista-chee@gmail.com' union all
Select 164, 'Jhung Fong Jordon', 'Koh', '1996-07-06', 'Male', 'SXXX2929A', '96926519', '' union all
Select 165, 'Badano Wells', 'Jenilie', '1981-05-27', 'Female', 'GXXX8060R', '94591422', '' union all
Select 166, 'Eng Guan Stanley', 'Tay', '1981-09-15', 'Male', 'SXXX9359G', '81023000', 'meblog88@yahoo.com' union all
Select 167, 'Lee Bee Bee', 'Fennie', '1975-01-01', 'Male', 'SXXX6732C', '88261743', '' union all
Select 168, 'Lalaine Biazon', 'Sinag', '1990-01-13', 'Female', 'GXXX1145U', '81839016', '' union all
Select 169, 'Lay Poi Peggy', 'Chua', '1971-06-16', 'Female', 'SXXX3551A', '94352209', 'chuapeiqi@yahoo.com' union all
Select 170, 'Siew King Cherrie', 'Chong', '1975-07-11', 'Female', 'SXXX9294C', '93364866', 'cherrie75@hotmail.com' union all
Select 171, 'Kah Mun Stanley', 'Wong', '1978-01-05', 'Female', 'FXXX4821Q', '97234221', '' union all
Select 172, 'Seah Sihui', 'Shandy', '1991-02-28', 'Female', 'SXXX7781G', '94566596', 'shandyseah@hotmail.com' union all
Select 173, 'Min Gui Jocelyn', 'Goh', '1991-11-26', 'Female', 'SXXX4345G', '96477372', 'jocelyngohmingui@gmail.com' union all
Select 174, 'Shu Hua', 'Lim', '1991-05-16', 'Female', 'SXXX6415I', '91773005', '' union all
Select 175, 'Chattopadhyay', 'Rekha', '1997-10-15', 'Female', 'SXXX5846Z', '90023397', 'tacokeko@gmail.com' union all
Select 176, 'Wee Jim Robbie', 'Tan', '1990-09-20', 'Male', 'SXXX3948F', '97289945', 'robbietanwj@outlook.com' union all
Select 177, 'Jia Zhi', 'Ho', '2004-11-25', 'Male', 'TXXX4021Z', '90600245', '' union all
Select 178, 'Jia Ming', 'Ho', '2007-11-27', 'Male', 'TXXX5944B', '90600245', '' union all
Select 179, 'Adilla Binte Harris Faizal', 'Fateen', '1999-03-03', 'Female', 'SXXX6931G', '90699653', 'fateenadilla@gmail.com' union all
Select 180, 'Tan Zi Shan', 'Sonia', '2001-07-01', 'Female', 'TXXX2918A', '97108829', 'soniatanzs@gmail.com' union all
Select 181, 'Yan Yan', 'Woo', '1992-11-02', 'Female', 'SXXX5113G', '81123247', '' union all
Select 182, 'Wen Qi Celeste', 'Toh', '2004-06-19', 'Female', 'TXXX6505A', '81384955', '' union all
Select 183, 'Bee Binte Mohamed Eusof', 'Aisha', '1977-02-25', 'Female', 'SXXX5872I', '88564031', 'sashaiwicy@gmail.com' union all
Select 184, 'Hui Ting Cheryl', 'Tan', '1998-12-15', 'Female', 'SXXX1666H', '97506104', '' union all
Select 185, 'Pei Yi Teri', 'Lee', '1999-02-10', 'Female', 'SXXX1740Z', '92791178', '' union all
Select 186, 'Charity Cabardo', 'Quilala', '1987-03-15', 'Female', 'GXXX3745U', '98344231', '' union all
Select 187, 'Sim Chee Kiat', 'Wallace', '1982-12-20', 'Male', 'SXXX1662E', '92996857', 'sqj18@yahoo.com.sg' union all
Select 188, 'Bryle Lilibeth', 'Jacinto', '1993-11-13', 'Female', 'SXXX5423I', '83886098', 'brylejacinto@gmail.com' union all
Select 189, 'Lai Chi Serene', 'Song', '1980-01-01', 'Female', 'SXXX0636E', '96189044', '' union all
Select 190, 'Kai Wei', 'Yeo', '1991-02-26', 'Female', 'SXXX6769B', '91120952', 'k.weii262@gmail.com' union all
Select 191, 'Ho Teck Beng Yap', 'Adrian', '1968-05-12', 'Male', 'SXXX0438Z', '92996339', 'adrianho12@hotmail.com' union all
Select 192, 'Chan Jin Tung', 'Valerie', '1999-10-23', 'Female', 'SXXX3913F', '96603863', '' union all
Select 193, 'D/O Ratanam', 'Bhavani', '1976-05-19', 'Female', 'SXXX6022H', '93655924', 'Vani323@gmail.com' union all
Select 194, 'Wee Ling Jay', 'Poo', '1968-02-19', 'Female', 'SXXX9936D', '96713223', '' union all
Select 195, 'Mei Qi Maggie', 'Mar', '1992-11-12', 'Female', 'SXXX6553I', '96256328', 'maemeiqi@hotmail.com' union all
Select 196, 'Li Min Sheryl', 'Lim', '2000-04-25', 'Female', 'TXXX3704E', '90052252', '' union all
Select 197, 'Rochelle', 'Tan', '2000-12-21', 'Female', 'TXXX7313D', '84814003', '' union all
Select 198, 'Maria Lourdes Gergorio', 'Flores', '1995-04-27', 'Female', 'MXXX6542K', '94227572', '' union all
Select 199, 'Aye Khiang Sueelay', 'Aye', '1989-10-09', 'Female', 'GXXX9032M', '84086041', '' union all
Select 200, 'Binte Daruwin', 'Zuriyani', '1995-06-17', 'Female', 'SXXX1799J', '88944965', '' union all
Select 201, 'Chai Hui Ting', 'Crystal', '2004-03-19', 'Female', 'TXXX7566D', '91861840', '' union all
Select 202, 'Win Khant Kristine', 'Khin', '1980-11-06', 'Female', 'GXXX2826Q', '81184590', '' union all
Select 203, 'Breakey', 'Priti', '1980-02-08', 'Female', 'GXXX2102Q', '98575469', '' union all
Select 204, 'Yin Ling Elaine', 'Siew', '1981-11-27', 'Female', 'SXXX2482B', '94308131', 'elainesiewyl@gmail.com' union all
Select 205, 'Lim Eng Choo', 'Irene', '1962-03-22', 'Female', 'SXXX5606J', '90116144', '' union all
Select 206, 'Learn', 'Tammy', '1972-06-12', 'Female', 'SXXX8140J', '91478349', 'tammy@myob.com' union all
Select 207, 'Ling Han Leon', 'Ye', '1999-03-10', 'Male', 'GXXX0804P', '84635146', '' union all
Select 208, 'Paulose Manohar', 'Arshnavi', '1998-02-12', 'Female', 'SXXX2345A', '81250826', '' union all
Select 209, 'Wai Kin Patrick', 'Wong', '1983-09-24', 'Male', 'SXXX9874Z', '89441004', 'wongpatrick2409@gmail.com' union all
Select 210, 'Nei Thluai', 'Van', '1990-07-19', 'Female', 'GXXX1587K', '83693876', '' union all
Select 211, 'Lee Hwa Ana', 'Ng', '1973-11-04', 'Female', 'SXXX2410D', '93847654', 'ana23lifestyle@yahoo.com.sg' union all
Select 212, 'Binte Md Shah Liz', 'Nursinah', '1981-03-05', 'Female', 'SXXX3229G', '83215154', 'sinahshah@yahoo.com.sg' union all
Select 213, 'Chen', 'Joey', '1992-08-10', 'Female', 'GXXX9963W', '98790092', 'tan.joey@hotmail.com' union all
Select 214, 'Jovilyn Louis Sta Maria', 'Aguilar', '1991-09-23', 'Female', 'GXXX0850T', '98527803', '' union all
Select 215, 'Cheang', 'Joey', '1993-03-09', 'Female', 'SXXX2985F', '81807721', '' union all
Select 216, 'Wen Yin Clara', 'Yong', '1993-10-13', 'Female', 'SXXX0200F', '81274859', '' union all
Select 217, 'Jefrey Acuna', 'Sabio', '1977-09-06', 'Male', 'GXXX1508L', '97278161', '' union all
Select 218, 'Lee Eng (Yvonne)', 'Tay', '1966-12-17', 'Female', 'SXXX7292Z', '97479557', '' union all
Select 219, 'Parvex @ Thossayapron Kittivarachate', 'Thossayapron', '1979-09-24', 'Female', 'SXXX4433A', '83225317', 'raih_parvex@hotmail.com' union all
Select 220, 'Kinchamwiliu', 'Newmai', '1989-07-27', 'Female', 'GXXX7260K', '86802106', '' union all
Select 221, 'Eni Greni Chandra', 'Rachel', '1989-07-11', 'Female', 'GXXX9454W', '87178362', '' union all
Select 222, 'Kuipers', 'Inge', '1973-11-14', 'Female', 'GXXX3201M', '91894715', '' union all
Select 223, 'Wei Ling Angela', 'Tan', '1998-11-14', 'Female', 'SXXX8758G', '88613440', 'yumidiaura@gmail.com' union all
Select 224, 'Zi Yi Kimberly', 'Low', '1998-03-13', 'Female', 'SXXX8453C', '96536840', '' union all
Select 225, 'Kum Hon', 'Tung', '1959-01-28', 'Male', 'SXXX0211E', '97661230', '' union all
Select 226, 'Li Xiang', 'Koh', '1979-01-05', 'Female', 'SXXX2547D', '98632579', 'lixiangkoh@gmail.com' union all
Select 227, 'Kolchinskaia', 'Valeriia', '2001-10-27', 'Female', '6XXXX69020', '93486114', '' union all
Select 228, 'Siew Luang Georgina', 'Yeo', '1967-10-23', 'Female', 'SXXX2295E', '88229299', '' union all
Select 229, 'Shamim', 'Rana', '1993-10-05', 'Male', 'GXXX7309L', '86209332', '' union all
Select 230, 'Tri Prasasti Murad', 'Zarah', '1974-03-17', 'Female', 'GXXX8236Q', '87223090', '' union all
Select 231, 'Jiao', 'Fu', '1983-03-11', 'Female', 'SXXX4598I', '96511229', '' union all
Select 232, 'Quek Xing Juan', 'Hazeline', '1994-11-04', 'Female', 'SXXX2280E', '81893219', '' union all
Select 233, 'Michelle Sarafina', 'Estrop', '2000-12-26', 'Female', 'TXXX4864D', '93823978', '' union all
Select 234, 'Lee Hong Qi', 'Josle', '1998-10-09', 'Female', 'SXXX3435A', '88870050', '' union all
Select 235, 'Selvia', 'Mega', '1990-07-03', 'Female', 'GXXX2940U', '82890211', '' union all
Select 236, 'Khatijah D/O Mohamed Abdul Wahab', 'Siti', '1983-08-09', 'Female', 'SXXX9878B', '98787210', '' union all
Select 237, 'Hong Jie', 'Wee', '1982-11-26', 'Male', 'SXXX9488E', '91831821', '' union all
Select 238, 'Wu Zi Amelia', 'Quek', '1988-01-18', 'Female', 'SXXX2640C', '83689399', 'amelia.qwz@gmail.com' union all
Select 239, 'Hamid', 'Haslinda', '1977-05-24', 'Female', 'SXXX3763G', '92981743', '' union all
Select 240, 'Foong Ying', 'Ming', '1969-10-31', 'Female', 'SXXX7657F', '92963110', '' union all
Select 241, 'Shan Ying', 'Chin', '1979-08-29', 'Female', 'SXXX4553D', '97474162', 'shining100@hotmail.com' union all
Select 242, 'Jie Si', 'Wee', '1992-10-07', 'Female', 'SXXX3259G', '91815631', '' union all
Select 243, 'Bth Shaik Uthuman', 'Habeebah', '1985-11-16', 'Female', 'SXXX6866D', '98804556', 'binzaghi85@gmail.com' union all
Select 244, 'Chai', 'Michelle', '2002-02-10', 'Female', 'MXXX3250K', '83090965', '' union all
Select 245, 'Tan', 'Natalie', '2010-06-05', 'Female', 'TXXX3467B', '96391682', '' union all
Select 246, 'Archanah', 'J', '1999-09-07', 'Female', 'SXXX2422C', '90624269', '' union all
Select 247, 'Li Basalla', 'Nichole', '1988-04-07', 'Female', 'SXXX3236D', '87171882', '' union all
Select 248, 'Wong Cui Yi', 'Brenda', '1993-07-27', 'Female', 'SXXX7451B', '97774023', '' union all
Select 249, 'James Dave Montecalvo', 'Getuaban', '1992-02-13', 'Male', 'GXXX0599T', '81049254', '' union all
Select 250, 'Lulu Saud A', 'Yousef', '2000-08-06', 'Female', 'GXXX4054Q', '87680109', '' union all
Select 251, 'Francisco De Jesus', 'Elizabeth', '1963-01-08', 'Female', 'SXXX0612C', '98736758', '' union all
Select 252, 'Woel Lin', 'Koh', '1978-01-30', 'Female', 'SXXX2210H', '85769985', '' union all
Select 253, 'Min Qi Quintessa', 'Wong', '2016-01-14', 'Female', 'TXXX2379A', '88637818', '' union all
Select 254, 'Chui Yeng Jacklyn', 'Fong', '1983-03-11', 'Female', 'SXXX6299C', '94892360', '' union all
Select 255, 'Evanleline De Gulman', 'Fruelda', '1977-07-11', 'Female', 'GXXX8411W', '91816184', '' union all
Select 256, 'Genalyn Amora', 'Arriesgado', '1989-01-18', 'Female', 'GXXX7486U', '89152231', '' union all
Select 257, 'Shah', 'Rabia', '1974-02-19', 'Female', 'SXXX8810J', '98632674', '' union all
Select 258, 'Zit Xin', 'Hor', '1995-09-11', 'Female', 'GXXX3169L', '94870250', '' union all
Select 259, 'Goh Zi Jun', 'Gavin', '1996-05-30', 'Male', 'SXXX9376I', '98894448', ''
) a
left join genders g on g.description = a.gender
where a.id <> 0;

Update patients 
set `code` = concat('PX-01-', LPAD(id, 5, '0'))
where id <> 0;