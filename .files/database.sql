PGDMP         ;        
    	    z            devav78g5h190     14.5 (Ubuntu 14.5-1.pgdg20.04+1)    14.4 "    ?           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            ?           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            ?           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            ?           1262    18416358    devav78g5h190    DATABASE     b   CREATE DATABASE devav78g5h190 WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'en_US.UTF-8';
    DROP DATABASE devav78g5h190;
                lbzwcrocuzsbwo    false            ?           0    0    DATABASE devav78g5h190    ACL     @   REVOKE CONNECT,TEMPORARY ON DATABASE devav78g5h190 FROM PUBLIC;
                   lbzwcrocuzsbwo    false    4330            ?           0    0    devav78g5h190    DATABASE PROPERTIES     Q   ALTER DATABASE devav78g5h190 SET search_path TO '$user', 'public', 'heroku_ext';
                     lbzwcrocuzsbwo    false                        2615    18416380 
   heroku_ext    SCHEMA        CREATE SCHEMA heroku_ext;
    DROP SCHEMA heroku_ext;
                u4p6nhjvbgf4t4    false            ?           0    0    SCHEMA heroku_ext    ACL     4   GRANT USAGE ON SCHEMA heroku_ext TO lbzwcrocuzsbwo;
                   u4p6nhjvbgf4t4    false    6            ?           0    0    SCHEMA public    ACL     ?   REVOKE ALL ON SCHEMA public FROM postgres;
REVOKE ALL ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO lbzwcrocuzsbwo;
GRANT ALL ON SCHEMA public TO PUBLIC;
                   lbzwcrocuzsbwo    false    5            ?           0    0    LANGUAGE plpgsql    ACL     1   GRANT ALL ON LANGUAGE plpgsql TO lbzwcrocuzsbwo;
                   postgres    false    843            ?            1259    18650697    produtos    TABLE     ?   CREATE TABLE public.produtos (
    id integer NOT NULL,
    tipo_id integer NOT NULL,
    nome character varying(255) NOT NULL,
    valor real NOT NULL
);
    DROP TABLE public.produtos;
       public         heap    lbzwcrocuzsbwo    false            ?            1259    18650701    produtos_id_seq    SEQUENCE     ?   ALTER TABLE public.produtos ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.produtos_id_seq
    START WITH 25
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 999999999
    CACHE 1
);
            public          lbzwcrocuzsbwo    false    211            ?            1259    18650702    tipos    TABLE        CREATE TABLE public.tipos (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    imposto numeric NOT NULL
);
    DROP TABLE public.tipos;
       public         heap    lbzwcrocuzsbwo    false            ?            1259    18650710    tipos_id_seq    SEQUENCE     ?   ALTER TABLE public.tipos ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.tipos_id_seq
    START WITH 7
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 999999999
    CACHE 1
);
            public          lbzwcrocuzsbwo    false    213            ?            1259    18650711    venda_produtos    TABLE        CREATE TABLE public.venda_produtos (
    id integer NOT NULL,
    produto_id integer NOT NULL,
    venda_id integer NOT NULL,
    descricao character varying(255),
    quantidade integer,
    preco_unitario real,
    impostos real,
    valor_total real
);
 "   DROP TABLE public.venda_produtos;
       public         heap    lbzwcrocuzsbwo    false            ?            1259    18650714    venda_produtos_id_seq    SEQUENCE     ?   ALTER TABLE public.venda_produtos ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.venda_produtos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 999999999
    CACHE 1
);
            public          lbzwcrocuzsbwo    false    215            ?            1259    18650715    vendas    TABLE     ?   CREATE TABLE public.vendas (
    id integer NOT NULL,
    data date NOT NULL,
    quantidade smallint NOT NULL,
    valor real NOT NULL,
    imposto real
);
    DROP TABLE public.vendas;
       public         heap    lbzwcrocuzsbwo    false            ?            1259    18594678    vendas_id_seq    SEQUENCE     v   CREATE SEQUENCE public.vendas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.vendas_id_seq;
       public          lbzwcrocuzsbwo    false            ?            1259    18650718    vendas_id_seq1    SEQUENCE     ?   ALTER TABLE public.vendas ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.vendas_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 99999999
    CACHE 1
);
            public          lbzwcrocuzsbwo    false    217            ?          0    18650697    produtos 
   TABLE DATA           <   COPY public.produtos (id, tipo_id, nome, valor) FROM stdin;
    public          lbzwcrocuzsbwo    false    211   C$       ?          0    18650702    tipos 
   TABLE DATA           2   COPY public.tipos (id, nome, imposto) FROM stdin;
    public          lbzwcrocuzsbwo    false    213   ?%       ?          0    18650711    venda_produtos 
   TABLE DATA           ?   COPY public.venda_produtos (id, produto_id, venda_id, descricao, quantidade, preco_unitario, impostos, valor_total) FROM stdin;
    public          lbzwcrocuzsbwo    false    215   &       ?          0    18650715    vendas 
   TABLE DATA           F   COPY public.vendas (id, data, quantidade, valor, imposto) FROM stdin;
    public          lbzwcrocuzsbwo    false    217   ?&       ?           0    0    produtos_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.produtos_id_seq', 65, true);
          public          lbzwcrocuzsbwo    false    212            ?           0    0    tipos_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.tipos_id_seq', 40, true);
          public          lbzwcrocuzsbwo    false    214            ?           0    0    venda_produtos_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.venda_produtos_id_seq', 42, true);
          public          lbzwcrocuzsbwo    false    216            ?           0    0    vendas_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.vendas_id_seq', 1, false);
          public          lbzwcrocuzsbwo    false    210            ?           0    0    vendas_id_seq1    SEQUENCE SET     =   SELECT pg_catalog.setval('public.vendas_id_seq1', 43, true);
          public          lbzwcrocuzsbwo    false    218            I           2606    18650729    produtos produtos_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.produtos
    ADD CONSTRAINT produtos_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.produtos DROP CONSTRAINT produtos_pkey;
       public            lbzwcrocuzsbwo    false    211            K           2606    18650731    tipos tipos_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.tipos
    ADD CONSTRAINT tipos_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.tipos DROP CONSTRAINT tipos_pkey;
       public            lbzwcrocuzsbwo    false    213            M           2606    18650733    vendas vendas_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.vendas
    ADD CONSTRAINT vendas_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.vendas DROP CONSTRAINT vendas_pkey;
       public            lbzwcrocuzsbwo    false    217            O           2606    18650734    venda_produtos pk_produto    FK CONSTRAINT     ~   ALTER TABLE ONLY public.venda_produtos
    ADD CONSTRAINT pk_produto FOREIGN KEY (produto_id) REFERENCES public.produtos(id);
 C   ALTER TABLE ONLY public.venda_produtos DROP CONSTRAINT pk_produto;
       public          lbzwcrocuzsbwo    false    4169    211    215            N           2606    18650740    produtos pk_tipo    FK CONSTRAINT     o   ALTER TABLE ONLY public.produtos
    ADD CONSTRAINT pk_tipo FOREIGN KEY (tipo_id) REFERENCES public.tipos(id);
 :   ALTER TABLE ONLY public.produtos DROP CONSTRAINT pk_tipo;
       public          lbzwcrocuzsbwo    false    211    213    4171            P           2606    18650745    venda_produtos pk_venda    FK CONSTRAINT     x   ALTER TABLE ONLY public.venda_produtos
    ADD CONSTRAINT pk_venda FOREIGN KEY (venda_id) REFERENCES public.vendas(id);
 A   ALTER TABLE ONLY public.venda_produtos DROP CONSTRAINT pk_venda;
       public          lbzwcrocuzsbwo    false    4173    215    217            ?   @  x?5??n?0E????X8??d????@???uy	&????C??????????;?????s?????޷.ܙ?TJ??m\?92?Zc|??&w%+K?Ȗ???S%>Y?io??? ?????rY??J?!?/*%"j?kן⷇A!?`???t???C?!???ɩ?u?????
S <??????. 
Np?W?L1??c7??V?(c?^??]?1cx?$/?ɲ???&?a*?????Luʭ?Vǹ=?X?? CO׋O?G?U ?nr?sh)??V?p?M
uCv?w?'u???S???̅M???w?aH5[%ޥ??sv      ?   u   x??1
?0@?Y:?O`*7??P:? YD?A?Yz???????\ٕ?"a?۪????^?n?KV?v	?k?)? O󦋟M?
f??ٯP%t?-?T???}?}?3N???"J      ?   ?   x???1?@??~E^`y}ǝ?:?@t??p??HH~@:[m?kAը*???????}?($? =???E?/?6?'_>p??????v????Ҳ?eM?CZ???i?iYY5-?t?m?!?????}'?N;??Z?;? ??7???_???      ?   M   x?U???0?f?"(?]???T??|?7??v????咼Y?$??%?7u????cQ3&?8??)?K^?Q"-     