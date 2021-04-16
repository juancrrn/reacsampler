<?php

namespace Juancrrn\Reacsampler\Common\View;

/**
 * Representa un modelo para las vistas.
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

abstract class ViewModel
{
	protected $nombre;
	protected $id;

	/**
	 * Procesa la lógica de la vista en el elemento <article>, que deberá 
	 * imprimir HTML y realizar lo que sea conveniente.
	 */
	abstract public function processContent(): void;

	public function getName(): string
	{
		return $this->nombre;
	}

	public function getId(): string
	{
		return $this->id;
	}
}

?>