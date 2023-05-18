<?php

namespace Raiz\Auxiliadores;

interface Serializador
{
  public function serializar(): array;
  public static function deserializar(array $datos): self;
}
