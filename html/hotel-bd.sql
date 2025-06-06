PGDMP                      }           hotel    17.4    17.4     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                           false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                           false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                           false            �           1262    16388    hotel    DATABASE     k   CREATE DATABASE hotel WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'es-MX';
    DROP DATABASE hotel;
                     Usu1    false            �            1259    16399    habitaciones    TABLE     �   CREATE TABLE public.habitaciones (
    id integer NOT NULL,
    nombre character varying(50),
    descripcion text,
    precio numeric(10,2),
    disponibilidad boolean,
    imagen text
);
     DROP TABLE public.habitaciones;
       public         heap r       postgres    false            �            1259    16398    habitaciones_id_seq    SEQUENCE     �   CREATE SEQUENCE public.habitaciones_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.habitaciones_id_seq;
       public               postgres    false    220            �           0    0    habitaciones_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.habitaciones_id_seq OWNED BY public.habitaciones.id;
          public               postgres    false    219            �            1259    16408    reservas    TABLE     �   CREATE TABLE public.reservas (
    id integer NOT NULL,
    usuario_id integer,
    habitacion_id integer,
    fecha_entrada date,
    fecha_salida date,
    estado character varying(20) DEFAULT 'pendiente'::character varying
);
    DROP TABLE public.reservas;
       public         heap r       postgres    false            �            1259    16407    reservas_id_seq    SEQUENCE     �   CREATE SEQUENCE public.reservas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.reservas_id_seq;
       public               postgres    false    222            �           0    0    reservas_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.reservas_id_seq OWNED BY public.reservas.id;
          public               postgres    false    221            �            1259    16390    usuarios    TABLE     �   CREATE TABLE public.usuarios (
    id integer NOT NULL,
    nombre character varying(100),
    correo character varying(100),
    clave character varying(255),
    rol boolean
);
    DROP TABLE public.usuarios;
       public         heap r       postgres    false            �            1259    16389    usuarios_id_seq    SEQUENCE     �   CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.usuarios_id_seq;
       public               postgres    false    218            �           0    0    usuarios_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;
          public               postgres    false    217            �           2604    16402    habitaciones id    DEFAULT     r   ALTER TABLE ONLY public.habitaciones ALTER COLUMN id SET DEFAULT nextval('public.habitaciones_id_seq'::regclass);
 >   ALTER TABLE public.habitaciones ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    220    219    220            �           2604    16411    reservas id    DEFAULT     j   ALTER TABLE ONLY public.reservas ALTER COLUMN id SET DEFAULT nextval('public.reservas_id_seq'::regclass);
 :   ALTER TABLE public.reservas ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    222    221    222            �           2604    16393    usuarios id    DEFAULT     j   ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);
 :   ALTER TABLE public.usuarios ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    218    217    218            �          0    16399    habitaciones 
   TABLE DATA           _   COPY public.habitaciones (id, nombre, descripcion, precio, disponibilidad, imagen) FROM stdin;
    public               postgres    false    220   g       �          0    16408    reservas 
   TABLE DATA           f   COPY public.reservas (id, usuario_id, habitacion_id, fecha_entrada, fecha_salida, estado) FROM stdin;
    public               postgres    false    222   !       �          0    16390    usuarios 
   TABLE DATA           B   COPY public.usuarios (id, nombre, correo, clave, rol) FROM stdin;
    public               postgres    false    218   �!       �           0    0    habitaciones_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.habitaciones_id_seq', 12, true);
          public               postgres    false    219            �           0    0    reservas_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.reservas_id_seq', 1, false);
          public               postgres    false    221            �           0    0    usuarios_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.usuarios_id_seq', 10, true);
          public               postgres    false    217                       2606    16406    habitaciones habitaciones_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.habitaciones
    ADD CONSTRAINT habitaciones_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.habitaciones DROP CONSTRAINT habitaciones_pkey;
       public                 postgres    false    220                       2606    16414    reservas reservas_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.reservas
    ADD CONSTRAINT reservas_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.reservas DROP CONSTRAINT reservas_pkey;
       public                 postgres    false    222            �           2606    16397    usuarios usuarios_correo_key 
   CONSTRAINT     Y   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_correo_key UNIQUE (correo);
 F   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_correo_key;
       public                 postgres    false    218            �           2606    16395    usuarios usuarios_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public                 postgres    false    218                       2606    16420 $   reservas reservas_habitacion_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.reservas
    ADD CONSTRAINT reservas_habitacion_id_fkey FOREIGN KEY (habitacion_id) REFERENCES public.habitaciones(id);
 N   ALTER TABLE ONLY public.reservas DROP CONSTRAINT reservas_habitacion_id_fkey;
       public               postgres    false    220    222    4609                       2606    16415 !   reservas reservas_usuario_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.reservas
    ADD CONSTRAINT reservas_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuarios(id);
 K   ALTER TABLE ONLY public.reservas DROP CONSTRAINT reservas_usuario_id_fkey;
       public               postgres    false    218    222    4607            �     x���Mn�0���)x W���q�E~ڠ@Q �n��y�H�ms���"G��:�Tׂ$h72dR�7�f�|����=q#��+�0�ۣ��5��-QY�~�o@u?�i]~ɿF|�7�$JMK�M��*]��&�
J�owP\���\\��{�m�W��*���P�@� X��V�bAh>J�턑e���{��⦪�k�C�+H!wd`�Z���W��Gw I�Ǟ(J�l=e��߰�Y>���V�����D$4�us���{�و����>�S��� i������za��|vO�U��Q��ֳ�|B[GX>��u���5í��؃l�������y�M�d���E����J��?�Qe�F?��m䝍x�h��k��Q�h�6��D�ň�ށ��������S���8J��&iHƛ5y�	O�|5O���0�+k8x#=�G,�͛��0�Y�l���~-֣�/��;���}�%ǯb��:,��`�CO*�����W�4���_¯�b�����M      �      x������ � �      �   �   x�e�Mo�0 ��s���6E�,�X�E��2�������h����_B���|V���`y�2��G����KV���t��Fy�� �oM&��ĉ�dW�.���,e����x�KN�?�º�Xϙ ��ꀸl\�M��/f�C�å������RQ�"������^U>���y��,҂!.O� �B��p�����[��xM�z<'mYG!)�U�PQ��eZ�     