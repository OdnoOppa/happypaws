-- Table: public.form

-- DROP TABLE IF EXISTS public.form;

CREATE TABLE IF NOT EXISTS public.form
(
    gender character(10) COLLATE pg_catalog."default",
    type character(20) COLLATE pg_catalog."default",
    location character(50) COLLATE pg_catalog."default",
    color character(20) COLLATE pg_catalog."default",
    id integer NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1 ),
    CONSTRAINT form_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.form
    OWNER to postgres;