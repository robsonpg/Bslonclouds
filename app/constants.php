<?php

//#########################################################################
// Essas constantes dependem do cadastro de permissões no banco de dados

const CONFIG_BACKSCATTERING = 1;
const CONFIG_FOWARDSCATTERING = 2;

const HENE_LASER_TYPE = "1";
const DIODE_LASER_TYPE = "2";
const OTHER_LASER_TYPE = "3";

const PERMISSION_PUBLIC = 1;
const PERMISSION_PRIVATE = 2;

const ATTR_USER = 1;
const ATTR_ADMIN = 2;
const ATTR_RESEARCHER = 3;
const ATTR_MODERATOR = 4;

const RESEARCH_STATUS_WAINTING_REVISION = 0; // Aguardando revisão
const RESEARCH_STATUS_ACCEPTED = 1; // Pesquisa aceita para publicação
const RESEARCH_STATUS_REJECTED = 2; // Pesquisa rejeitada