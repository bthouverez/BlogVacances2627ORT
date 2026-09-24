<?php

require_once 'User.php';

class Article {

	private int $id;
	private string $title;
	private string $body;
	private ?string $image;
	private string $postedAt;
	
	private User $user;

	public function __construct(int $i = 0, string $t = 'titre', string $b = 'corps', ?string $im = '', string $pa = '') {
			$this->id = $i;
			$this->title = $t;
			$this->body = $b;
			$this->image = $im;
			$this->postedAt = $pa;
			$this->user = new User;
	}


	public function getId(): int { return $this->id; }
	public function getTitle(): string { return $this->title; }
	public function getBody(): string { return $this->body; }
	public function getImage(): ?string { return $this->image; }
	public function getPostedAt(): string { return $this->postedAt; }
	public function getUser() : User { return $this->user; }

	public function setId(string $i): void { $this->id = $i; }
	public function setTitle(string $t): void { $this->title = $t; }
	public function setBody(string $b): void { $this->body = $b; }
	public function setImage(?string $i): void { $this->image = $i; }
	public function setPostedAt(string $p): void { $this->postedAt = $p; }
	public function setUser(User $u) { $this->user = $u; }

	public function getCleanPostedAt() {
		$date = date_create($this->postedAt);
		return date_format($date, 'd M Y à H:i');
	}

}